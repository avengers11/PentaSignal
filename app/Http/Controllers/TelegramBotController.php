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
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Excel as ExcelFormat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TelegramBotController extends Controller
{
    //+++++++++++++++++++++++++++++++++++++++
    private $bot;
    //+++++++++++++++++++++++++++++++++++++++
    public function __construct()
    {
        $this->bot = new TeleBot(env('TELEGRAM_BOT_TOKEN'));
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
            else if($callbackData == "trade_volume_question_amount_usdt"){
                // $this->tradeVolumeQuestionAmountUSDT($chatId, "Not Set");
                $this->telegramMessageType("trade_volume_question_amount_usdt", $chatId);
            }
            else if($callbackData == "trade_volume_question_amount_coins"){
                // $this->tradeVolumeQuestionAmountCOIN($chatId, "Not Set");
                $this->telegramMessageType("trade_volume_question_amount_coins", $chatId);
            }
            // strat tracking 
            else if($callbackData == "start_tracking"){
                $schedule = ScheduleCrypto::where("chat_id", $chatId)->where("status", "pending")->first();
                $schedule->status = "waiting"; 
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
            
            /*
            =================
            TRDAE NOTIFICATION  
            =================
            */
            else if(str_starts_with($callbackData, 'update_trade_stop_loss_')){
                $id = str_replace('update_trade_stop_loss_', '', $callbackData);
                $schedule = ScheduleCrypto::where('id', $id)->first();
                $user->state = "update_trade_stop_loss_$id";
                $user->save();


                $this->telegramMessageType("update_trade_loss", $chatId);
            }
           

            /*
            =================
            My Trade Section
            =================
            */
            // close trade 
            else if(str_starts_with($callbackData, 'close_trade_')){
                $scheduleId = str_replace('close_trade_', '', $callbackData);
                if(!ScheduleCrypto::where('id', $scheduleId)->where('status', 'closed')->exists()){
                    $this->telegramMessageType("close_trade", $chatId, ["id" => $scheduleId]);
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
                if(!ScheduleCrypto::where('id', $scheduleId)->where('status', 'closed')->exists()){
                    $tradeUpdated = ScheduleCrypto::where('id', $scheduleId)->update(['status' => 'closed']);
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
                $data = str_replace('statistics_trades_type_', '', $callbackData);
                $explode = explode("_", $data);
                $type = $explode[0];
                $date = $explode[1];

                $this->telegramMessageType("statistics", $chatId, ["type" => $type, "date" => $date]);
            }
            else if(str_starts_with($callbackData, 'statistics_trades_change_time')){
                $data = str_replace('statistics_trades_change_time_', '', $callbackData);
                $explode = explode("_", $data);
                $type = $explode[0];
                $date = $explode[1];

                $this->telegramMessageType("statistics_trades_change_time", $chatId, ["type" => $type, "date" => $date]);
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
            $user->state = null;
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
            elseif($user->state == "trade_volume_question_amount_usdt"){
                $this->tradeVolumeQuestionAmountUSDT($chatId, $text);
            }
            elseif($user->state == "trade_volume_question_amount_coins"){
                $this->tradeVolumeQuestionAmountCOIN($chatId, $text);
            }

            // loss
            elseif($user->state == ""){
                $this->tradeVolumeQuestionAmountCOIN($chatId, $text);
            }
            else if(str_starts_with($user->state, 'update_trade_stop_loss_')){
                $id = str_replace('update_trade_stop_loss_', '', $user->state);

                $schedule = ScheduleCrypto::where('id', $id)->first();
                $schedule->stop_loss = $text;
                $schedule->save();

                $user->state = null;
                $user->save();

                $this->bot->sendMessage([
                    'chat_id' => $chatId,
                    'text' => <<<EOT
                    <b>✅ Congratulations! Stop loss successfully updated.</b>
                    EOT,
                    'parse_mode' => 'HTML',
                ]);
            }
        }
        
        return response('ok');
    }
    /*
    TELEGRAM ALL MSG
    */
    private function telegramMessageType($type, $chatId, $data=[])
    {
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);

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

            // Get all latest running trades
            $schedules = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", ["running", "waiting"])
            ->get();

            // Group instruments by market & format them
            $groupedInstruments = $schedules->groupBy('market')->map(function ($group) {
                return $group->pluck('instruments')
                    ->map(fn($item) => str_replace('-', '', strtoupper($item)))
                    ->unique()
                    ->values();
            })->toArray();

            // If No Active Trades
            if(count($schedules) < 1){
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => <<<EOT
                    <b>📋 You have no active trades.</b>

                    Forward a signal from SignalVision to start tracking.
                    EOT,
                    'parse_mode' => 'HTML'
                ]);
                return "ok";
            }
        
            $combainData = combineCryptoPrices($groupedInstruments)->getData(true);
            
            foreach ($schedules as $value) {
                $type = strtoupper($value->type);
                $currentPrice = isset($combainData[$value->market][$value->instrument]) ? formatNumberFlexible($combainData[$value->market][$value->instrument]) : null;

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
            $schedule = ScheduleCrypto::where('id', $data["id"])->first();

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>❓ Are you sure you want to close this trade?</b>
                
                $schedule->instruments $schedule->tp_mode
                Entry: $schedule->entry_target$
                Stop Loss: $schedule->stop_loss$

                EOT,
                'parse_mode' => 'HTML',

                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '✅ Yes, Close Trade', 'callback_data' => "yes_close_trade_".$data['id']],
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

            $user->state = "track_new_signal";
            $user->save();
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

                📌 Please choose the type of amount you'll use for this trade — for example, in coins (e.g., BTC, ETH) or in USDT.
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '💵 USDT', 'callback_data' => 'trade_volume_question_amount_usdt'],
                            ['text' => '🪙 Coins', 'callback_data' => 'trade_volume_question_amount_coins'],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "trade_volume_question_amount_usdt"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>💰 What's the size of your trade?</b>

                <b>Please enter either:</b>
                - The amount in USDT (e.g., 100)
                EOT,
                'parse_mode' => 'HTML',
            ]);

            $user->state = "trade_volume_question_amount_usdt";
            $user->save();
        }
        else if($type == "trade_volume_question_amount_coins"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>💰 What's the size of your trade?</b>

                <b>Please enter either:</b>
                - Number of coins (e.g., 0.5 BTC)
                EOT,
                'parse_mode' => 'HTML'
            ]);

            $user->state = "trade_volume_question_amount_coins";
            $user->save();
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
                        ],
                        [
                            ['text' => '📋 All Trades', 'callback_data' => 'history_trades_type_all'],
                            ['text' => '📊 Statistics', 'callback_data' => 'statistics_trades_type_real_all'],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "history_trades_type"){
            $type = $data['type'];

            // header 
            $headerRealTradeColumn = ["Trading pair", "Direction", "Entry price", "Stop Loss level", "Take Profit targets", "Entry date/time", "Exit date/time", "Result", "Percentage profit/loss", "Actual profit/loss amount", "Volume traded", "Leverage used", "Profit strategy used", "Partial profits taken", "Days in trade"];
            $headerDemoTradeColumn = ["Trading pair", "Direction", "Entry price", "Stop Loss level", "Take Profit targets", "Entry date/time", "Exit date/time", "Result", "Theoretical profit/loss percentage", "Days in trade"];
            $headerAllTradeColumn = ["Trading pair", "Direction", "Entry price", "Stop Loss level", "Take Profit targets", "Entry date/time", "Exit date/time", "Result", "Theoretical profit/loss percentage", "Days in trade", "Type"];

            // 1. Define select fields
            $selectFields = [
                'instruments as Trading_pair',
                'tp_mode as Direction',
                'entry_target as Entry_price',
                'stop_loss as Stop_Loss_level',
                'profit_strategy as Take_Profit_targets',
                'trade_entry as Entry_date_time',
                'trade_exit as Exit_date_time',
                'profit_loss as Result',
                'profit_loss as Percentage_profit_loss',
            ];

            // 2. Conditionally add fields if type is 'real'
            if ($type === 'real') {
                $selectFields = array_merge($selectFields, [
                    'actual_profit_loss as Actual_profit_loss_amount',
                    'leverage as Volume_traded',
                    'leverage as Leverage_used',
                    'profit_strategy as Profit_strategy_used',
                    DB::raw("CONCAT_WS(', ', partial_profits_tp1, partial_profits_tp2, partial_profits_tp3, partial_profits_tp4, partial_profits_tp5) as Partial_profits_taken"),
                ]);
            }

            // 3. Add Days in trade
            $selectFields[] = DB::raw("DATEDIFF(trade_exit, trade_entry) as Days_in_trade");

            // 4. Get the data
            $schedules = ScheduleCrypto::where('chat_id', $chatId)
                ->when($type !== 'all', fn($q) => $q->where('type', $type))
                ->select($selectFields)
                ->get();

            // 5. Log or handle if empty
            if ($schedules->isEmpty()) {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "❗ No trades found to export.",
                ]);
                return;
            }


            $headerRow = array_keys($schedules->first()->toArray());
            $dataRows = $schedules->map(function ($item) {
                return array_values($item->toArray());
            })->toArray();

            // 6. Prepare Excel data
            $excelData = collect([$headerRow])->merge($dataRows);

            // 7. Store Excel file
            $fileName = $type . "_trades.xlsx";
            $tempPath = 'temp/' . $fileName;

            Excel::store(new class($excelData) implements \Maatwebsite\Excel\Concerns\FromCollection {
                public function __construct(public Collection $data) {}
                public function collection() {
                    return $this->data;
                }
            }, $tempPath, 'local');

            // 8. Send the file to Telegram
            $fileFullPath = storage_path("app/{$tempPath}");

            Telegram::sendDocument([
                'chat_id' => $chatId,
                'document' => fopen($fileFullPath, 'r'),
                'caption' => '📥 Here is your Excel file containing trade history.',
            ]);

            // 9. Delete temp file
            unlink($fileFullPath);
        }
        else if($type == "statistics"){
            $type = $data['type'];
            $typeUC = ucfirst($data['type']);
            $date = $data['date'];
            $dateUC = ucfirst($data['date']);

            // date text 
            $dateTxt = "";
            if($date == "7"){
                $dateTxt = "Last Week";
            }else if($date == "30"){
                $dateTxt = "Last Month";
            }else if($date == "90"){
                $dateTxt = "Last 3 Months";
            }else{
                $dateTxt = "All Time";
            }

            // Get schedules based on type
            $schedules = ScheduleCrypto::where('chat_id', $chatId)
            ->when($type !== 'all', fn($q) => $q->where('type', $type))
            ->when($date !== 'all', function ($q) use ($date) {
                $q->whereDay('created_at', $date);
            })
            ->get();


            // Count totals
            $totalTrade = $schedules->count();
            $totalProfitTrade = $schedules->where('profit_loss', 'profit')->count();
            $totalLossTrade = $schedules->where('profit_loss', 'loss')->count();

            // Calculated values with safe division
            $safeDivide = fn($a, $b) => $b > 0 ? round(($a / $b) * 100, 2) : 0;

            $totalProfitLossTrade   = $safeDivide($totalProfitTrade, $totalLossTrade);
            $totalAverageWinTrade   = $safeDivide($totalTrade, $totalProfitTrade);
            $totalAverageLossTrade  = $safeDivide($totalTrade, $totalLossTrade);
            $totalWinRateTrade      = $safeDivide($totalProfitTrade, $totalTrade);

            // Filter 
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                📈 Trading Performance:
                
                📅 Trade Type: {$typeUC}
                📅 Time Period: {$dateTxt}
                📊 Total Trades: {$totalTrade}
                ✅ Profitable Trades: {$totalProfitTrade}
                ❌ Loss Trades: {$totalLossTrade}
                💰 Total Profit/Loss: {$totalProfitLossTrade}%
                📈 Average Win: {$totalAverageWinTrade}%
                📉 Average Loss: {$totalAverageLossTrade}%
                ⚡ Win Rate: {$totalWinRateTrade}%
                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '💰 Real', 'callback_data' => "statistics_trades_type_real_all"],
                            ['text' => '🕹️ Demo', 'callback_data' => "statistics_trades_type_demo_all"],
                        ],
                        [
                            ['text' => '📋 All Trades', 'callback_data' => "statistics_trades_type_all_all"],
                        ],
                        [
                            ['text' => '🗓️ Change Time Period', 'callback_data' => "statistics_trades_change_time_".$type."_all"],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "statistics_trades_change_time"){
            $type = ucfirst($data['type']);

            // Filter 
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "⏳ Choose a Time Period to Filter Your {$type} Trade Performance:",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '📅 Last Week', 'callback_data' => "statistics_trades_type_".$type."_7"],
                            ['text' => '🗓️ Last Month', 'callback_data' => "statistics_trades_type_".$type."_30"],
                        ],
                        [
                            ['text' => '📊 Last 3 Months', 'callback_data' => "statistics_trades_type_".$type."_90"],
                            ['text' => '🌐 All Time', 'callback_data' => "statistics_trades_type_".$type."_all"],
                        ]
                    ]
                ])
            ]);
        }

       /*
        =====================
            Notifications  
        =====================
        */
        else if($type == "update_trade_loss"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>💰 What's the new stop loss?</b>

                <b>Please enter:</b>
                - The amount in Digit (e.g., 100, 10.10)
                EOT,
                'parse_mode' => 'HTML',
            ]);
        }
        
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
    public function  tradeVolumeQuestionAmountUSDT($chatId, $text)
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

        if (strlen($text) > 11) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>❌ Number must not be longer than 20 characters.</b>
                EOT,
            ]);
            return; 
        }

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

        $text = trim($text);
        $schedule->position_size_usdt = $text;
        $schedule->save();

        $user->state = "start_tracking";
        $user->save();
    }
    public function  tradeVolumeQuestionAmountCOIN($chatId, $text)
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

        if (strlen($text) > 11) {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => '❌ Number must not be longer than 20 characters.',
            ]);
            return; 
        }

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

        
        $text = trim($text);
        $schedule->position_size_coin = $text;
        $schedule->save();

        $user->state = "start_tracking";
        $user->save();
    }



    /*
    Resoarch 
    */
    public function crypto(Request $request)
    {
        $details = [
            "binance" => [
                "BTCUSDT",
                "LTCUSDT"
            ],
            "bybit" => [
                "BTCUSDT"
            ]
        ];

        $response = Http::get("https://msw-app.com/crypto", [
            "details" => $details
        ]);
        
        return $response->json();


        $combainData = combineCryptoPrices($details)->getData(true);

        return (float)$combainData["bybit"]["BTCUSDT"];
    }
}