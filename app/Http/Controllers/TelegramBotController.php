<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramUser;
use WeStacks\TeleBot\TeleBot;
use App\Models\ScheduleCrypto;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Keyboard\Keyboard;
use Illuminate\Support\Facades\Response;
use WeStacks\TeleBot\Objects\ReplyKeyboardMarkup;
use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Models\TelegraphBot;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    //+++++++++++++++++++++++++++++++++++++++
    private $bot;
    //+++++++++++++++++++++++++++++++++++++++
    public function __construct()
    {
        $this->bot = new TeleBot(env('TELEGRAM_BOT_HTTP'));
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function index()
    {
        return view('welcome');
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function telegram_webhook(Request $request)
    {
        $data = $request->all();

        // ✅ Handle button click (callback_query)
        if (isset($data['callback_query'])) {
            $callbackData = $data['callback_query']['data'];
            $chatId = $data['callback_query']['message']['chat']['id'];
            $messageId = $data['callback_query']['message']['message_id'];
            $callbackId = $data['callback_query']['id'];
            $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);

            // home 
            if($callbackData == "main_menu"){
                $this->telegramMessageType("main_menu", $chatId);
            }

            // help 
            else if($callbackData == "help"){
                $this->telegramMessageType("help", $chatId);
            }

            /*
            ===================
            NEW TRADE OPEN
            ===================
            */
            // new signal  
            else if($callbackData == "try_another_signal"){
                $this->telegramMessageType("track_signal", $chatId);
                $user->state = "track_new_signal";
            }
            // select exchange  
            else if(str_starts_with($callbackData, 'exchange_')){
                $explode = explode("_", $callbackData);
                if(ScheduleCrypto::where("id", $explode[2])->exists()){
                    $schedule = ScheduleCrypto::where("id", $explode[2])->first();
                    $schedule->market = $explode[1];
                    $schedule->save();

                    $market = ucfirst($explode[1]);
                    // send message 
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => <<<EOT
                        <b>📊 You selected:</b> <code>$market</code>

                        Is this a real trade you're taking or just for tracking/demo purposes.
                        EOT,
                        'parse_mode' => 'HTML',
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [
                                    ['text' => '💰 Real Trade', 'callback_data' => "trade_type_real"],
                                    ['text' => '🎮 Demo Only', 'callback_data' => "trade_type_demo"],
                                ]
                            ]
                        ])
                    ]);
                }else{
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Something went wrong, Try again?",
                    ]);
                }
            }
            // trade_type 
            else if(str_starts_with($callbackData, 'trade_type_')){
                $type = str_replace('trade_type_', '', $callbackData);
                $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
                $schedule->type = $type; 
                $schedule->save();

                $this->telegramMessageType("trade_type", $chatId);
            }
            // take partial profits
            else if($callbackData == "take_partial_profits" || $callbackData == "edit_partial_profit_strategy"){
                $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
                $schedule->profit_strategy = "partial_profits";
                $schedule->partial_profits_tp1 = null;
                $schedule->partial_profits_tp2 = null;
                $schedule->partial_profits_tp3 = null;
                $schedule->partial_profits_tp4 = null;
                $schedule->partial_profits_tp5 = null;
                $schedule->save();

                $user->state = "take_partial_profits";
                $this->telegramMessageType("take_partial_profits", $chatId, ["tp" => 1]);
            }
            else if(str_starts_with($callbackData, 'take_partial_profits__')){
                $percentage = str_replace('take_partial_profits__', '', $callbackData);
                $this->takePartialProfits($chatId, $percentage);
            }
            else if($callbackData == "confirm_partial_profit_strategy"){
                $user->state = "trade_volume_question_amount";
                $this->telegramMessageType("trade_volume_question_amount", $chatId);
            }
            // Trade Volume Question
            else if($callbackData == "trade_volume_question_amount_skip"){
                $this->tradeVolumeQuestionAmount($chatId, "Not Set");
            }
            else if($callbackData == "trade_volume_question_coin_skip"){
                $this->tradeVolumeQuestionCoin($chatId, "Not Set");
            }
            // strat tracking 
            else if($callbackData == "start_tracking"){
                $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
                $schedule->status = "running"; 
                $schedule->save();
                $user->state = null;

                $this->bot->editMessageText([
                    'chat_id' => $chatId,
                    'message_id' => $messageId,
                    'text' => "✅ Congratulations! Your trade is now being tracked.",
                ]);
            }
            // menual
            else if($callbackData == "manual_management"){
                $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
                $schedule->profit_strategy = "manual_management";
                $schedule->save();

                $this->telegramMessageType("trade_volume_question_amount", $chatId);
            }
            
            // // close specific tp
            // else if($callbackData == "close_specific_tp"){
            //     $this->telegramMessageType("close_specific_tp", $chatId);
            // }
            // else if(str_starts_with($callbackData, 'close_specific_tp')){
            //     $tp = str_replace('close_specific_tp_', '', $callbackData);
            //     $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
            //     $schedule->specific_tp = $tp;
            //     $schedule->profit_strategy = "specific_tp";
            //     $schedule->save();

            //     $this->telegramMessageType("trade_volume_question_amount", $chatId);
            // }

           

            /*
            =================
            My Trade Section
            =================
            */
            // close trade 
            else if(str_starts_with($callbackData, 'close_trade_')){
                $scheduleId = str_replace('close_trade_', '', $callbackData);
                if(!ScheduleCrypto::where('id', $scheduleId)->where('status', 'close')->exists()){
                    $this->telegramMessageType("close_trade", $chatId, ["scheduleId" => $scheduleId]);
                }else{
                    $this->bot->editMessageText([
                        'chat_id' => $chatId,
                        'message_id' => $messageId,
                        'text' => "⚠️ This trade was already closed.",
                        'parse_mode' => 'HTML',
                    ]);
                }
                
            }
            // yes close trade
            else if(str_starts_with($callbackData, 'yes_close_trade_')){
                $scheduleId = str_replace('yes_close_trade_', '', $callbackData);
                if(!ScheduleCrypto::where('id', $scheduleId)->where('status', 'close')->exists()){
                    $tradeUpdated = ScheduleCrypto::where('id', $scheduleId)->update(['status' => 'close']);
                    $this->bot->editMessageText([
                        'chat_id' => $chatId,
                        'message_id' => $messageId,
                        'text' => "✅ Trade Closed Successfully!",
                        'parse_mode' => 'HTML',
                    ]);
                }else{
                    $this->bot->editMessageText([
                        'chat_id' => $chatId,
                        'message_id' => $messageId,
                        'text' => "⚠️ This trade was already closed.",
                        'parse_mode' => 'HTML',
                    ]);
                }
            }
            // cancel close trade
            else if($callbackData === 'cancel_close_trade'){
                $this->bot->deleteMessage([
                    'chat_id' => $chatId,
                    'message_id' => $messageId,
                ]);
            }
            

             /*
            =================
            Trade History 
            =================
            */ 
            else if(str_starts_with($callbackData, 'history_trades_type')){
                $type = str_replace('history_trades_type_', '', $callbackData);
                $this->telegramMessageType("history_trades_type", $chatId, ["type" => $type]);
            }
            else if(str_starts_with($callbackData, 'statistics_trades_type')){
                $type = str_replace('statistics_trades_type_', '', $callbackData);
                $this->telegramMessageType("statistics_trades_type", $chatId, ["type" => $type]);
            }

            $user->save();
            
            return response('ok');
        }

        if (!isset($data['message'])) {
            return response('ok');
        }

        $chatId = $data['message']['chat']['id'];
        $text = trim($data['message']['text'] ?? '');
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);

        // start
        if ($text === '/start' || $text === '🏠 Main Menu') {
            $this->telegramMessageType("main_menu", $chatId);
            $user->state = null;
        }

        // track signal 
        if ($text === '➕ Track Signal') {
            $user->state = "track_new_signal";
            $user->save();

            $this->telegramMessageType("track_signal", $chatId);
        }

        // history  
        if ($text === '📊 History') {
            $user->state = null;
            $user->save();

            $this->telegramMessageType("history", $chatId);
        }

        // help
        elseif ($text === '/help' || $text === '🆘 Help') {
            $this->telegramMessageType("help", $chatId);
            $user->state = null;

        }

        // list
        elseif ($text === '/list' || $text === '📋 My Signals' || $text === "🔄 Refresh") {
            $this->telegramMessageType("my_signals", $chatId);
            $user->state = null;
        }
        
        // cancel
        elseif ($text === '/cancel') {
            $schedules = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", "running")
            ->get();
        
            $messages = [];
            foreach ($schedules as $value) {
                $messages[] = [
                    'text' => <<<EOT
                    <b>📊 Coin:</b> <code>{$value->instruments}</code>
                    <b>📈 Type:</b> {$value->tp_mode}
                    <b>🎯 Entry:</b> <code>{$value->entry_target}</code>
                    <b>🛑 SL:</b> <code>{$value->stop_loss}</code>
                    EOT,
                    'reply_markup' => Keyboard::make([
                        'inline_keyboard' => [
                            [
                                ['text' => '❌ Cancel Trade', 'callback_data' => "cancel_trade_{$value->id}"]
                            ]
                        ]
                    ]),
                ];
            }
            
            foreach ($messages as $message) {
                $this->bot->sendMessage([
                    'chat_id' => $chatId,
                    'text' => $message['text'],
                    'parse_mode' => 'HTML',
                    'reply_markup' => $message['reply_markup'],
                ]);
            }
            
            $user->state = null;

        }
        
        // else  
        else {
            // new signal 
            if($user->state == "track_new_signal"){
                // $user->state = null;

                // 🧹 Clean input
                $text = preg_replace('/[^\x20-\x7E]/', '', $text); // remove emojis
                $text = trim($text);

                // 🔍 Extract coin pair (e.g., BTC/USDT)
                preg_match('/\b([A-Z0-9]+)\/([A-Z]{3,5})\b/i', $text, $matches);
                // 🔍 Trade mode
                preg_match('/\b(SHORT|LONG)\b/i', $text, $modeMatch);
                // 💸 Entry Target
                preg_match('/Entry Target:\s*\$?([\d\.]+)/i', $text, $entryMatch);
                // 🛑 Stop Loss
                preg_match('/SL:\s*\$?([\d\.]+)/i', $text, $slMatch);
                // 🎯 TP1–TP6
                preg_match_all('/\d+\)\s*\$?([\d,\.]+)/', $text, $tpMatches);
                // Cross
                preg_match('/\bCross\s*\((\d+X)\)/i', $text, $leverageMatch);

                if (
                    isset($matches[1]) &&
                    isset($matches[2]) &&
                    isset($leverageMatch[1]) &&
                    isset($modeMatch[1]) &&
                    isset($entryMatch[1]) &&
                    isset($slMatch[1]) &&
                    isset($tpMatches[1])
                ) {
                    $base = strtoupper($matches[1]);
                    $quote = strtoupper($matches[2]);
                    $coinType = "$base-$quote";

                    // 🔍 Trade mode
                    $tpMode = strtoupper($modeMatch[1] ?? 'UNKNOWN');
                    // 💸 Entry Target
                    $entryTarget = $entryMatch[1] ?? null;
                    // Cross
                    $leverage = $leverageMatch[1] ?? null;
                    // 🛑 Stop Loss
                    $stopLoss = $slMatch[1] ?? null;
                    // 🎯 TP1–TP6
                    $tpPoints = $tpMatches[1] ?? [];

                    Log::info($text);

                    // Assign to individual variables safely
                    $tp1 = $tpPoints[0] ?? null;
                    $tp2 = $tpPoints[1] ?? null;
                    $tp3 = $tpPoints[2] ?? null;
                    $tp4 = $tpPoints[3] ?? null;
                    $tp5 = $tpPoints[4] ?? null;


                    // ✅ Send detected data
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => <<<EOT
                        <b>📊 I've received your signal for $coinType</b>
                    
                        <b>Type:</b> $tpMode  
                        <b>Entry:</b> $entryTarget$  
                        <b>Stop Loss:</b> $stopLoss$
                        
                        <b>Take Profit Levels:</b>  
                        <b>🎯TP1:</b> $tp1$
                        <b>🎯TP2:</b> $tp2$
                        <b>🎯TP3:</b> $tp3$
                        <b>🎯TP4:</b> $tp4$
                        <b>🎯TP5:</b> $tp5$
                        
                        Is this a real trade you're taking or just for tracking/demo purposes?
                        EOT,
                        'parse_mode' => 'HTML'
                    ]);

                    // save data 
                    ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->delete();

                    $crypto = new ScheduleCrypto();
                    $crypto->chat_id = $chatId;
                    $crypto->instruments = $coinType;
                    $crypto->entry_target = $entryTarget;
                    $crypto->leverage = $leverage;
                    $crypto->tp_mode = $tpMode;
                    $crypto->stop_loss = $stopLoss;
                    $crypto->take_profit1 = $tp1;
                    $crypto->take_profit2 = $tp2;
                    $crypto->take_profit3 = $tp3;
                    $crypto->take_profit4 = $tp4;
                    $crypto->take_profit5 = $tp5;
                    $crypto->status = "pending";
                    $crypto->save();

                    // trding market 
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Please select the exchange you're trading on:",
                        'reply_markup' => json_encode([
                            'inline_keyboard' => [
                                [
                                    ['text' => 'Binance', 'callback_data' => "exchange_binance_$crypto->id"],
                                    ['text' => 'Bybit', 'callback_data' => "exchange_bybit_$crypto->id"],
                                ],
                                [
                                    ['text' => 'OKX', 'callback_data' => "exchange_okx_$crypto->id"],
                                    ['text' => 'Kraken', 'callback_data' => "exchange_kraken_$crypto->id"],
                                ],
                                [
                                    ['text' => 'Deribit', 'callback_data' => "exchange_deribit_$crypto->id"],
                                    ['text' => 'KuCoin', 'callback_data' => "exchange_kucoin_$crypto->id"],
                                ]
                            ]
                        ])
                    ]);

                    return;
                    // 📈 Price fetching
                    $bybitInfo = bybitInfo($coinType, $market);
                    if ($bybitInfo["status"]) {
                        $price = $bybitInfo['price'];
                        $this->bot->sendMessage([
                            'chat_id' => $chatId,
                            'text' => "💰 Current Price of $coinType: $price USD",
                        ]);

                        // save data 
                        $crypto = new ScheduleCrypto();
                        $crypto->chat_id = $chatId;
                        $crypto->instruments = $coinType;
                        $crypto->entry_target = $entryTarget;
                        $crypto->market = $market;
                        $crypto->tp_mode = $tpMode;
                        $crypto->stop_loss = $stopLoss;
                        $crypto->take_profit1 = $tp1;
                        $crypto->take_profit2 = $tp2;
                        $crypto->take_profit3 = $tp3;
                        $crypto->take_profit4 = $tp4;
                        $crypto->take_profit5 = $tp5;
                        $crypto->take_profit6 = $tp6;
                        $crypto->status = "running";
                        $crypto->save();

                    } else {
                        $this->bot->sendMessage([
                            'chat_id' => $chatId,
                            'text' => "❌ Error fetching price: " . $bybitInfo["msg"],
                        ]);
                    }

                } else {
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => <<<EOT
                        ⚠️ <b>Unrecognized Signal Format</b>
                        I couldn't automatically parse this signal format.
                        
                        <b>If you're a premium user:</b>
                        We'll add this signal format to our database soon. Please contact support to expedite this process.
                        
                        <b>If you're using demo mode:</b>
                        Demo mode only supports <b>SignalVision</b> format signals. Please use a SignalVision signal or upgrade to premium for support of additional formats.
                        EOT,
                        'parse_mode' => 'HTML',
                        'reply_markup' => Keyboard::make([
                            'inline_keyboard' => [
                                [
                                    ['text' => '🔁 Try Another Signal', 'callback_data' => 'try_another_signal']
                                ],
                                [
                                    ['text' => '🚀 Upgrade to Premium', 'callback_data' => 'upgrade_premium']
                                ],
                                [
                                    ['text' => '🏠 Main Menu', 'callback_data' => 'main_menu']
                                ]
                            ]
                        ])
                    ]);
                }
            }
            // partial profits 
            elseif($user->state == "take_partial_profits"){
                $this->takePartialProfits($chatId, $text);
            }
            // question 
            elseif($user->state == "trade_volume_question_amount"){
                $this->tradeVolumeQuestionAmount($chatId, $text);
            }
            elseif($user->state == "trade_volume_question_coin"){
                $this->tradeVolumeQuestionCoin($chatId, $text);
            }
        }

        
        return response('ok');
    }
    /*
    TELEGRAM ALL MSG
    */
    private function telegramMessageType($type, $chatId, $data=[])
    {
        // main menu
        if($type == "main_menu"){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                ⚠️ <b>🚀 Welcome to SignalAlert! </b>
                I'm your personal trading assistant that will track your signals and alert you when price targets are reached.
                
                <b>If you're a premium user:</b>
                We'll add this signal format to our database soon. Please contact support to expedite this process.

                ⭐ You are currently in DEMO MODE and can track up to 3 signals for free.
                
                <b>To get started:</b>
                1️⃣ Forward a trading signal from SignalVision or other signal providers
                2️⃣ I'll set up alerts for your signal's entry points, stop loss, and take profit levels

                ⚠️ Note: Demo mode supports SignalVision signals only. For other signal formats, a premium license is required.

                Want unlimited signals and premium features?

                Visit signalvision.ai/pricing to get your subscription.

                EOT,
                'parse_mode' => 'HTML',

                'reply_markup' => json_encode([
                    'keyboard' => [
                        ['➕ Track Signal', '📋 My Signals'],
                        ['📊 History', '🔑 License'],
                        ['🆘 Help']
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true
                ])
            ]);
        }

        // help
        else if($type == "help"){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>📚 SignalAlert Bot Features:</b>
                
                <b>🔍 SIGNAL TRACKING</b>
                • Track signals from SignalVision and other providers
                • Real-time price monitoring
                • Instant alerts when targets are reached
                • Support for multiple trading pairs

                <b>📊 TRADE MANAGEMENT</b>
                • Separate real and demo trades
                • Customize take profit strategies
                • Update stop loss levels in real-time
                • Track trade performance

                <b>📈 HISTORY & ANALYTICS</b>
                • Complete trading history
                • Performance statistics
                • Downloadable reports
                • Win rate and profit tracking

                <b>💳 SUBSCRIPTION</b>
                • Demo: 3 free signals (SignalVision format only)
                • Premium: Unlimited signals, all providers, analytics

                Need assistance? Contact support@signalvision.ai

                EOT,
                'parse_mode' => 'HTML',

                'reply_markup' => json_encode([
                    'keyboard' => [
                        ['🏠 Main Menu'],
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true
                ])
            ]);
        }

        /*
        ==========================
        My Signals
        ==========================
        */
        // My Signals
        else if($type == "my_signals"){
            $schedules = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", "running")
            ->get();

            // If No Active Trades
            if(count($schedules) < 1){
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => <<<EOT
                    <b>📋 You have no active trades.</b>

                    Forward a signal from SignalVision to start tracking.
                    EOT,
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode([
                        'keyboard' => [
                            ['📈 View History', '🏠 Main Menu']
                        ],
                        'resize_keyboard' => true,
                        'one_time_keyboard' => true
                    ])
                ]);
                return "ok";
            }
        
            foreach ($schedules as $value) {
                $type = strtoupper($value->type);

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => <<<EOT
                    <b>{$value->instruments} | {$value->tp_mode} | {$type}</b>

                    <b>🎯 Entry:</b> <code>{$value->entry_target}$</code>
                    <b>💵 Current Price:</b> <code>120$</code>
                    <b>🛑 SL:</b> <code>{$value->stop_loss}$</code>
                    <b>🚀 Highest TP Reached:</b> <code>TP3</code> (<code>54545.656$</code>)
                    <b>⚙️ Leverage:</b> {$value->leverage}
                    EOT,
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [
                                ['text' => '✏️ Edit Trade', 'callback_data' => 'edit_trade'],
                                ['text' => '❌ Close Trade', 'callback_data' => "close_trade_$value->id"],
                            ]
                        ]
                    ])
                ]);
            }
            
            // Send it via Telegram bot with HTML formatting
            $totalActive = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", "running")
            ->count();
            $totalReal = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", "!=", "pending")
            ->where("type", "real")
            ->count();
            $totalDemo = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", "!=", "pending")
            ->where("type", "demo")
            ->count();

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "You have $totalActive active trades. $totalReal real and $totalDemo demo.",
                'reply_markup' => json_encode([
                    'keyboard' => [
                        ['🔄 Refresh', '➕ Track Signal'],
                        ['📊 History', '🏠 Main Menu']
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true
                ])
            ]);
        }
        // close trade
        else if($type == "close_trade"){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>❓ Are you sure you want to close this trade?</b>
                
                [PAIR-USDT] [LONG/SHORT]
                Entry: [Entry Price]
                Current Price: [Current Price]
                Profit/Loss: [P/L%]

                EOT,
                'parse_mode' => 'HTML',

                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '✅ Yes, Close Trade', 'callback_data' => "yes_close_trade_".$data['scheduleId']],
                            ['text' => '❌ Cancel', 'callback_data' => 'cancel_close_trade'],
                        ]
                    ]
                ])
            ]);
        }
        

        /*
        =====================
            ADD NEW TRADE
        =====================
        */
        // track signal
        else if($type == "track_signal"){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                📤 Forward a Trading Signal

                Please forward a signal from SignalVision or another signal provider.

                I'll analyze the message and set up alerts for:

                Entry price

                Stop loss

                Take profit levels

                ⚠️ Note:
                Demo users can only forward SignalVision format signals.
                To track other signal types, please upgrade to premium.
                EOT,
                'parse_mode' => 'HTML'
            ]);
        }
        // trade type  
        else if($type == "trade_type"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>📝 Let's set up your real trade tracking.</b>
                
                What's your strategy for taking profits?

                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '💸 Partial Profits', 'callback_data' => 'take_partial_profits'],
                            ['text' => '🎯 Close at Specific TP', 'callback_data' => 'close_specific_tp'],
                        ],
                        [
                            ['text' => '🛠️ Manual Management', 'callback_data' => 'manual_management'],
                        ]
                    ]
                ])
            ]);
        }
        // partial 
        else if($type == "take_partial_profits"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>Please specify the percentage to close at TP{$data['tp']}:</b>
                
                (Click a button or type a custom percentage directly)

                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '10%', 'callback_data' => 'take_partial_profits__10'],
                            ['text' => '20%', 'callback_data' => 'take_partial_profits__20'],
                            ['text' => '25%', 'callback_data' => 'take_partial_profits__25'],
                        ],
                        [
                            ['text' => '50%', 'callback_data' => 'take_partial_profits__50'],
                            ['text' => '75%', 'callback_data' => 'take_partial_profits__75'],
                            ['text' => '100%', 'callback_data' => 'take_partial_profits__100'],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "partial_profit_strategy_set"){
            $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();

            $tp1 = is_null($schedule->partial_profits_tp1) ? 0 : $schedule->partial_profits_tp1;
            $tp2 = is_null($schedule->partial_profits_tp2) ? 0 : $schedule->partial_profits_tp2;
            $tp3 = is_null($schedule->partial_profits_tp3) ? 0 : $schedule->partial_profits_tp3;
            $tp4 = is_null($schedule->partial_profits_tp4) ? 0 : $schedule->partial_profits_tp4;
            $tp5 = is_null($schedule->partial_profits_tp5) ? 0 : $schedule->partial_profits_tp5;

            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>✅ Partial profit strategy set:</b>
                TP1: {$tp1}%
                TP2: {$tp2}%
                TP3: {$tp3}%
                TP4: {$tp4}%
                TP5: {$tp5}%
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '✅ Confirm', 'callback_data' => 'confirm_partial_profit_strategy'],
                            ['text' => '✏️ Edit', 'callback_data' => 'edit_partial_profit_strategy'],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "close_specific_tp"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>📍 At which Take Profit level would you like to close your entire position?</b>
                
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '🎯 TP1', 'callback_data' => 'close_specific_tp_1'],
                            ['text' => '🎯 TP2', 'callback_data' => 'close_specific_tp_2'],
                            ['text' => '🎯 TP3', 'callback_data' => 'close_specific_tp_3']
                        ],
                        [
                            ['text' => '🎯 TP4', 'callback_data' => 'close_specific_tp_4'],
                            ['text' => '🎯 TP5', 'callback_data' => 'close_specific_tp_5'],
                            ['text' => '🎯 TP6', 'callback_data' => 'close_specific_tp_6'],
                        ]
                    ]
                ])
            ]);
        }
        // questions 
        else if($type == "trade_volume_question_amount"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>💰 What's the size of your trade?</b>

                <b>Please enter either:</b>
                - The amount in USDT (e.g., 100)

                Type your answer or tap [Skip] to continue without recording size.
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '🎯 Skip', 'callback_data' => 'trade_volume_question_amount_skip']
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "trade_volume_question_coin"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>💰 What's the size of your trade?</b>

                <b>Please enter either:</b>
                - Number of coins (e.g., 0.5 BTC)

                Type your answer or tap [Skip] to continue without recording size.
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '🎯 Skip', 'callback_data' => 'trade_volume_question_coin_skip']
                        ]
                    ]
                ])
            ]);
        }

        /*
        =====================
            history
        =====================
        */
        else if($type == "history"){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                📜 Please select an option to view your trade history details:
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '💰 Real Trades', 'callback_data' => 'history_trades_type_real'],
                            ['text' => '🕹️ Demo Trades', 'callback_data' => 'history_trades_type_demo'],
                            ['text' => '📋 All Trades', 'callback_data' => 'history_trades_type_all'],
                        ],
                        [
                            ['text' => '📥 Download Excel', 'callback_data' => 'download_excel'],
                            ['text' => '📊 Statistics', 'callback_data' => 'statistics'],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "history_trades_type"){
            $type = $data['type'];

            for ($i=0; $i < 11; $i++) { 
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => <<<EOT
                    [PAIR1-USDT] [LONG/SHORT] {$type}
                    Entry: [Entry]
                    Exit: [Exit]
                    Result: [Hit TP3/SL/Manually Closed]
                    Date: [Date Range]
                    EOT,
                    'parse_mode' => 'HTML',
                ]);
            }

            // Filter 
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => '⏳ Choose a Time Period to Filter Your Trade History:',
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '📆 Last Week', 'callback_data' => "history_trades_type_week_$type"],
                            ['text' => '🗓️ Last Month', 'callback_data' => "history_trades_type_month_$type"],
                            ['text' => '📊 Last 3 Months', 'callback_data' => "history_trades_3month_type_$type"],
                        ],
                        [
                            ['text' => '📥 Download Excel', 'callback_data' => "download_trades_type_$type"],
                            ['text' => '📈 View Statistics', 'callback_data' => "statistics_trades_type_$type"],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "statistics_trades_type"){
            $type = $data['type'];

            // Filter 
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                📈 Trading Performance: {$type}
                
                📅 Time Period: [Selected Period]
                📊 Total Trades: [X]
                ❌ Loss Trades: [Z] ([Z/X]%)
                💰 Total Profit/Loss: [P/L%] ([P/L USDT])
                📈 Average Win: [Avg Win%]
                📉 Average Loss: [Avg Loss%]
                ⚡ Win Rate: [Win Rate%]
                📊 Profit Factor: [Profit Factor]
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '💰 Real Trades', 'callback_data' => "history_trades_type_week_$type"],
                            ['text' => '🕹️ Demo Trades', 'callback_data' => "history_trades_type_month_$type"],
                            ['text' => '📋 All Trades', 'callback_data' => "history_trades_3month_type_$type"],
                        ],
                        [
                            ['text' => '🗓️ Change Time Period', 'callback_data' => "change_time_period_$type"],
                            ['text' => '📥 Download Excel', 'callback_data' => "download_excel_type_$type"],
                        ]
                    ]
                ])
            ]);
        }


        // else if($type == "equal_each_tp"){
        //     $this->bot->sendMessage([
        //         'chat_id' => $chatId,
        //         'text' => <<<EOT
        //         <b>What percentage of your position would you like to close at each TP level?</b>

        //         EOT,
        //         'parse_mode' => 'HTML',
        //         'reply_markup' => Keyboard::make([
        //             'inline_keyboard' => [
        //                 [
        //                     ['text' => '10%', 'callback_data' => 'equal_each_tp'],
        //                     ['text' => '20%', 'callback_data' => 'custom_setup'],
        //                     ['text' => '30%', 'callback_data' => 'custom_setup'],
        //                     ['text' => '40%', 'callback_data' => 'custom_setup'],
        //                     ['text' => '50%', 'callback_data' => 'custom_setup'],
        //                 ],
        //                 [
        //                     ['text' => '🛠️Custom', 'callback_data' => 'custom_setup'],
        //                 ]
        //             ]
        //         ])
        //     ]);
        // }else if($type == "custom_setup"){
        //     $this->bot->sendMessage([
        //         'chat_id' => $chatId,
        //         'text' => <<<EOT
        //     <b>Please specify the percentage to close at each TP level:</b>
        //     EOT,
        //         'parse_mode' => 'HTML',
        //         'reply_markup' => Keyboard::make([
        //             'inline_keyboard' => [
        //                 [
        //                     [
        //                         'text' => '📋 Open Form',
        //                         'web_app' => ['url' => 'https://signalvision.ai/web-app/custom-partial']
        //                     ]
        //                 ]
        //             ]
        //         ])
        //     ]);
        // }
        
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function takePartialProfits($chatId, $text)
    {
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);
        $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
        if(empty($schedule)){
            $user->state = "track_new_signal";
            $user->save();

            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => "Something went wrong, Please with new signal!",
            ]);

            return "ok";
        }

        $text = (int)trim($text);
        if (is_int($text)) {
            $tpPoint = 1;

            if(is_null($schedule->partial_profits_tp1)){
                $total = $text;
                if($total > 100){
                    // msg 
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Please adjust your total partial profits to be under 100%.",
                    ]);

                    return response('ok');
                }else{
                    $schedule->partial_profits_tp1 = $text;
                    $schedule->save();

                    $tpPoint = 2;
                }
            }
            else if(is_null($schedule->partial_profits_tp2)){
                $total = (int)($schedule->partial_profits_tp1 + $text);
                if($total > 100){
                    $current = $total-$text;
                    // msg 
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Please adjust your total partial profits to be under 100%\nCurrent partial profits: $current%",
                    ]);

                    return response('ok');
                }else{
                    $schedule->partial_profits_tp2 = $text;
                    $schedule->save();

                    $tpPoint = 3;
                }
            }
            else if(is_null($schedule->partial_profits_tp3)){
                $total = (int)($schedule->partial_profits_tp1 + $schedule->partial_profits_tp2 + $text);
                if($total > 100){
                    $current = $total-$text;
                    // msg 
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Please adjust your total partial profits to be under 100%\nCurrent partial profits: $current%",
                    ]);

                    return response('ok');
                }else{
                    $schedule->partial_profits_tp3 = $text;
                    $schedule->save();

                    $tpPoint = 4;
                }
            }
            else if(is_null($schedule->partial_profits_tp4)){
                $total = (int)($schedule->partial_profits_tp1 + $schedule->partial_profits_tp2 + $schedule->partial_profits_tp3 + $text);
                if($total > 100){
                    $current = $total-$text;
                    // msg 
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Please adjust your total partial profits to be under 100%\nCurrent partial profits: $current%",
                    ]);
                    return response('ok');
                }else{
                    $schedule->partial_profits_tp4 = $text;
                    $schedule->save();

                    $tpPoint = 5;
                }
            }
            else if(is_null($schedule->partial_profits_tp5)){
                $total = (int)($schedule->partial_profits_tp1 + $schedule->partial_profits_tp2 + $schedule->partial_profits_tp3 + $schedule->partial_profits_tp4 + $text);
                if($total > 100){
                    $current = $total-$text;
                    // msg 
                    $this->bot->sendMessage([
                        'chat_id' => $chatId,
                        'text' => "Please adjust your total partial profits to be under 100%\nCurrent partial profits: $current%",
                    ]);
                }else{
                    $schedule->partial_profits_tp5 = $text;
                    $schedule->save();

                    // $user->state = "partial_profit_strategy_set";
                    // $user->save();

                    $this->telegramMessageType("partial_profit_strategy_set", $chatId);
                }
                
                return response('ok');
            }

            $total = (int)($schedule->partial_profits_tp1 + $schedule->partial_profits_tp2 + $schedule->partial_profits_tp3 + $schedule->partial_profits_tp4 + $schedule->partial_profits_tp5);
            if($total == 100){
                // $user->state = "partial_profit_strategy_set";
                // $user->save();
                $this->telegramMessageType("partial_profit_strategy_set", $chatId);
            }else{
                $this->telegramMessageType("take_partial_profits", $chatId, ["tp" => $tpPoint]);
            }

        }else{
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => "Please enter a valid integer between 1 and 100 (e.g., 10, 100).",
            ]);
        }
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function  tradeVolumeQuestionAmount($chatId, $text)
    {
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);
        $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
        if(empty($schedule)){
            $user->state = "track_new_signal";
            $user->save();

            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => "Something went wrong, Please with new signal!",
            ]);

            return "ok";
        }

        $text = trim($text);
        $schedule->position_size_usdt = $text;
        $schedule->save();

        $user->state = "trade_volume_question_coin";
        $user->save();

        $this->telegramMessageType("trade_volume_question_coin", $chatId);
    }
    public function  tradeVolumeQuestionCoin($chatId, $text)
    {
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);
        $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => <<<EOT
            <b>✅ Trade Tracking Setup Complete!</b>

            EOT,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => '✅ Start Tracking', 'callback_data' => "start_tracking"],
                        ['text' => '✏️ Edit Settings', 'callback_data' => "edit_trade_settings"],
                    ]
                ]
            ])
        ]);

        $schedule->position_size_coin = $text;
        $schedule->save();

        $user->state = "start_tracking";
        $user->save();
    }
    
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function handleCallbackQuery($update)
    {
        $callback = $update->getCallbackQuery();
        $data = $callback->getData(); // e.g., "cancel_trade_12"

        if (\Illuminate\Support\Str::startsWith($data, 'cancel_trade_')) {
            $tradeId = str_replace('cancel_trade_', '', $data);

            // Cancel the trade in your backend
            $trade = ScheduleCrypto::find($tradeId);
            if ($trade && $trade->status === 'running') {
                $trade->status = 'cancelled';
                $trade->save();

                $this->bot->answerCallbackQuery([
                    'callback_query_id' => $callback->getId(),
                    'text' => "✅ Trade for {$trade->instruments} has been cancelled.",
                    'show_alert' => false
                ]);
            } else {
                $this->bot->answerCallbackQuery([
                    'callback_query_id' => $callback->getId(),
                    'text' => "⚠️ Trade already cancelled or not found.",
                    'show_alert' => true
                ]);
            }
        }
    }



    /*
    Resoarch 
    */
    public function customPartial()
    {
        return view("telegram.custom-partial");
    }
}