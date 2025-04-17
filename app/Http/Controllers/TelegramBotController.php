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

        $chatId = $data['message']['chat']['id'];



        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];
        
        $this->bot->sendMessage([
              'chat_id' => $chatId,
              'text' => 'Hello World',
              'reply_markup' => json_encode([
                  'keyboard' => $keyboard,
                  'resize_keyboard' => true,
                  'one_time_keyboard' => true
              ])
          ]);

        return ;
        
        // ✅ Handle button click (callback_query)
        if (isset($data['callback_query'])) {
            $callbackData = $data['callback_query']['data'];
            $chatId = $data['callback_query']['message']['chat']['id'];
            $messageId = $data['callback_query']['message']['message_id'];

            // camcel trade 
            if (str_starts_with($callbackData, 'cancel_trade_')) {
                $scheduleId = str_replace('cancel_trade_', '', $callbackData);

                // Cancel the trade
                ScheduleCrypto::where('id', $scheduleId)->update(['status' => 'cancelled']);

                // Respond to button press to remove the "loading" spinner
                $this->bot->answerCallbackQuery([
                    'callback_query_id' => $data['callback_query']['id'],
                    'text' => '✅ Trade cancelled!',
                    'show_alert' => false,
                ]);

                // Optional: Edit the message to reflect cancellation
                $this->bot->editMessageText([
                    'chat_id' => $chatId,
                    'message_id' => $messageId,
                    'text' => '🚫 Trade has been cancelled.',
                    'parse_mode' => 'HTML',
                ]);
            }

            // home 
            else if($callbackData == "main_menu"){
                $this->telegramMessageType("main_menu", $chatId);
            }

            // help 
            else if($callbackData == "help"){
                $this->telegramMessageType("help", $chatId);
            }

            // real trade  
            else if($callbackData == "real_trade"){
                $this->telegramMessageType("real_trade", $chatId);
            }

            // take partial profits
            else if($callbackData == "take_partial_profits"){
                $this->telegramMessageType("take_partial_profits", $chatId);
            }

            // close specific tp
            else if($callbackData == "close_specific_tp"){
                $this->telegramMessageType("close_specific_tp", $chatId);
            }

            // equal each tp
            else if($callbackData == "equal_each_tp"){
                $this->telegramMessageType("equal_each_tp", $chatId);
            }

            // custom_setup
            else if($callbackData == "custom_setup"){
                $this->telegramMessageType("custom_setup", $chatId);
            }

            return response('ok');
        }

        if (!isset($data['message'])) {
            return response('ok');
        }

        $chatId = $data['message']['chat']['id'];
        $text = trim($data['message']['text'] ?? '');
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);

        if ($text === '/start') {
            $this->telegramMessageType("main_menu", $chatId);
            $user->state = null;
        } elseif ($text === '/help') {
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => "📞 Help Desk: +1 800 123 4567\nEmail: support@example.com",
            ]);
            $user->state = null;

        }elseif ($text === '/list') {
            $schedules = ScheduleCrypto::latest()
            ->where("chat_id", $chatId)
            ->where("status", "running")
            ->get();
        
            $messages = [];
            
            foreach ($schedules as $value) {
                $messages[] = <<<EOT
                <b>📊 Coin:</b> <code>{$value->instruments}</code>
                <b>📈 Type:</b> {$value->tp_mode}
                <b>🎯 Entry:</b> <code>{$value->entry_target}</code>
                <b>🛑 SL:</b> <code>{$value->stop_loss}</code>
                ───────────────
                EOT;
            }
            
            // Join all messages into one
            $finalMessage = implode("\n\n", $messages);
            
            // Send it via Telegram bot with HTML formatting
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => $finalMessage,
                'parse_mode' => 'HTML',
            ]);
            
            $user->state = null;

        }elseif ($text === '/cancel') {
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

        }else { 
            // 🧹 Clean input
            $text = preg_replace('/[^\x20-\x7E]/', '', $text); // remove emojis
            $text = trim($text);

            // 🔍 Extract coin pair (e.g., BTC/USDT)
            preg_match('/\b([A-Z0-9]+)\/([A-Z]{3,5})\b/i', $text, $matches);
            // marketplace 
            preg_match('/Exchange:\s*([A-Za-z]+)/i', $text, $exchangeMatch);
            // 🔍 Trade mode
            preg_match('/\b(SHORT|LONG)\b/i', $text, $modeMatch);
            // 💸 Entry Target
            preg_match('/Entry Target:\s*\$?([\d\.]+)/i', $text, $entryMatch);
            // 🛑 Stop Loss
            preg_match('/SL:\s*\$?([\d\.]+)/i', $text, $slMatch);
            // 🎯 TP1–TP6
            preg_match_all('/\d\)\s*([\d\.]+)/', $text, $tpMatches);

            if (
                isset($matches[1]) &&
                isset($matches[2]) &&
                isset($exchangeMatch[1]) &&
                isset($modeMatch[1]) &&
                isset($entryMatch[1]) &&
                isset($slMatch[1])
            ) {
                $base = strtoupper($matches[1]);
                $quote = strtoupper($matches[2]);
                $coinType = "$base-$quote";

                // market
                $market = strtolower($exchangeMatch[1]) ?? null;
                // 🔍 Trade mode
                $tpMode = strtoupper($modeMatch[1] ?? 'UNKNOWN');
                // 💸 Entry Target
                $entryTarget = $entryMatch[1] ?? null;
                // 🛑 Stop Loss
                $stopLoss = $slMatch[1] ?? null;
                // 🎯 TP1–TP6
                $tpPoints = $tpMatches[1] ?? [];
                // Assign to individual variables safely
                $tp1 = $tpPoints[0] ?? null;
                $tp2 = $tpPoints[1] ?? null;
                $tp3 = $tpPoints[2] ?? null;
                $tp4 = $tpPoints[3] ?? null;
                $tp5 = $tpPoints[4] ?? null;
                $tp6 = $tpPoints[5] ?? null;

                $this->bot->sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Your message content goes here",
                    'parse_mode' => 'HTML',
                    'reply_markup' => [
                        'keyboard' => [
                            [
                                ['text' => '🎯 TP1', 'callback_data' => 'close_specific_tp1'], // Regular keyboard button
                            ]
                        ],
                        'resize_keyboard' => true,  // To resize the keyboard
                        'one_time_keyboard' => true // To hide the keyboard after use
                    ]
                ]);

                return ;
                // ✅ Send detected data
                $this->bot->sendMessage([
                    'chat_id' => $chatId,
                    'text' => <<<EOT
                    <b>📊 I've received your signal for $coinType</b>
                
                    <b>Type:</b> $tpMode  
                    <b>Entry:</b> $entryTarget$  
                    <b>Stop Loss:</b> $stopLoss$
                    
                    <b>Take Profit Levels:</b>  
                    🎯TP1: $tp1$  
                    🎯TP2: $tp2$  
                    🎯TP3: $tp3$  
                    🎯TP4: $tp4$  
                    🎯TP5: $tp5$  
                    🎯TP6: $tp6$
                    
                    Is this a real trade you're taking or just for tracking/demo purposes?
                    EOT,
                    'parse_mode' => 'HTML',
                    'reply_markup' => new ReplyKeyboardMarkup(
                        [
                            [
                                ['text' => '🟢 Real Trade'],
                                ['text' => '🧪 Demo Only']
                            ]
                        ], // keyboard
                        true, // resize_keyboard
                        true, // one_time_keyboard
                        false, // selective
                        null, // input_field_placeholder
                        false // is_persistent
                    )
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

        $user->save();
        return response('ok');
    }
    /*
    TELEGRAM ALL MSG
    */
    private function telegramMessageType($type, $chatId)
    {
        if($type == "main_menu"){
            $this->bot->sendMessage([
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

                Visit signalvision.com/pricing to get your subscription.

                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '📡 Track Signal', 'callback_data' => 'try_another_signal'],
                            ['text' => '📋 My Signals', 'callback_data' => 'upgrade_premium']
                        ],
                        [
                            ['text' => '📊 History', 'callback_data' => 'main_menu'],
                            ['text' => '🧾 License', 'callback_data' => 'main_menu']
                        ],
                        [
                            ['text' => '🆘 Help', 'callback_data' => 'help']
                        ]
                    ]
                ])
            ]);
        }else if($type == "help"){
            $this->bot->sendMessage([
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

                Need assistance? Contact support@signalvision.com

                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '🏠 Main Menu', 'callback_data' => 'main_menu'],
                        ],
                    ]
                ])
            ]);
        }
        
        // real trade 
        else if($type == "real_trade"){
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
                            ['text' => '💸 Take Partial Profits', 'callback_data' => 'take_partial_profits'],
                        ],
                        [
                            ['text' => '🎯 Close at Specific TP', 'callback_data' => 'close_specific_tp'],
                        ],
                        [
                            ['text' => '🛠️ Manual Management', 'callback_data' => 'manual_management'],
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "take_partial_profits"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>🔄 How would you like to distribute your partial profits?</b>
                
                What's your strategy for taking profits?

                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '⚖️ Equal at Each TP', 'callback_data' => 'equal_each_tp'],
                            ['text' => '🧩 Custom Setup', 'callback_data' => 'custom_setup'],
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
                            ['text' => '🎯 TP1', 'callback_data' => 'close_specific_tp1'],
                            ['text' => '🎯 TP2', 'callback_data' => 'close_specific_tp2'],
                            ['text' => '🎯 TP3', 'callback_data' => 'close_specific_tp3']
                        ],
                        [
                            ['text' => '🎯 TP4', 'callback_data' => 'close_specific_tp4'],
                            ['text' => '🎯 TP5', 'callback_data' => 'close_specific_tp5'],
                            ['text' => '🎯 TP6', 'callback_data' => 'close_specific_tp6'],
                        ]
                    ]
                ])
            ]);
        }

        else if($type == "equal_each_tp"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
                <b>What percentage of your position would you like to close at each TP level?</b>

                EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            ['text' => '10%', 'callback_data' => 'equal_each_tp'],
                            ['text' => '20%', 'callback_data' => 'custom_setup'],
                            ['text' => '30%', 'callback_data' => 'custom_setup'],
                            ['text' => '40%', 'callback_data' => 'custom_setup'],
                            ['text' => '50%', 'callback_data' => 'custom_setup'],
                        ],
                        [
                            ['text' => '🛠️Custom', 'callback_data' => 'custom_setup'],
                        ]
                    ]
                ])
            ]);
        }else if($type == "custom_setup"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
            <b>Please specify the percentage to close at each TP level:</b>
            EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => '📋 Open Form',
                                'web_app' => ['url' => 'https://signalvision.ai/web-app/custom-partial']
                            ]
                        ]
                    ]
                ])
            ]);
        }
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
                            [
                                'text' => '📋 Open Form',
                                'web_app' => ['url' => 'https://signalvision.ai/web-app/custom-partial']
                            ]
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "trade_volume_question_amount"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
            <b>💰 What's the size of your trade?</b>

            <b>Please enter either:</b>
            - The amount in USDT (e.g., 100)
            - Percentage of your balance (e.g., 5%)
            - Number of coins (e.g., 0.5 BTC)

            Type your answer or tap [Skip] to continue without recording size.
            EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => '📋 Open Form',
                                'web_app' => ['url' => 'https://signalvision.ai/web-app/custom-partial']
                            ]
                        ]
                    ]
                ])
            ]);
        }
        else if($type == "trade_volume_question_amount"){
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => <<<EOT
            <b>💰 What's the size of your trade?</b>

            <b>Please enter either:</b>
            - The amount in USDT (e.g., 100)
            - Percentage of your balance (e.g., 5%)
            - Number of coins (e.g., 0.5 BTC)

            Type your answer or tap [Skip] to continue without recording size.
            EOT,
                'parse_mode' => 'HTML',
                'reply_markup' => Keyboard::make([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => '📋 Open Form',
                                'web_app' => ['url' => 'https://signalvision.ai/web-app/custom-partial']
                            ]
                        ]
                    ]
                ])
            ]);
        }
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function aiShedule($text)
    {

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