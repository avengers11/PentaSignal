<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramUser;
use WeStacks\TeleBot\TeleBot;
use App\Models\ScheduleCrypto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Telegram\Bot\Keyboard\Keyboard;


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
        
        \Log::info($data);
        // ✅ Handle button click (callback_query)
        if (isset($data['callback_query'])) {
            $callbackData = $data['callback_query']['data'];
            $chatId = $data['callback_query']['message']['chat']['id'];
            $messageId = $data['callback_query']['message']['message_id'];

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

            return response('ok');
        }

        if (!isset($data['message'])) {
            return response('ok');
        }

        $chatId = $data['message']['chat']['id'];
        $text = trim($data['message']['text'] ?? '');
        $user = TelegramUser::firstOrCreate(['chat_id' => $chatId]);

       


        if ($text === '/start') {
            $this->bot->sendMessage([
                'chat_id' => $chatId,
                'text' => "👋 Welcome to the bot! Use /help or /api_token to proceed.",
            ]);
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

            if (isset($matches[1], $matches[2])) {
                $base = strtoupper($matches[1]);
                $quote = strtoupper($matches[2]);
                $coinType = "$base-$quote";

                // market
                preg_match('/Exchange:\s*\$?([\d\.]+)/i', $text, $exchangeMatch);
                $market = strtolower($exchangeMatch[1]) ?? null;

                // 🔍 Trade mode
                preg_match('/\b(SHORT|LONG)\b/i', $text, $modeMatch);
                $tpMode = strtoupper($modeMatch[1] ?? 'UNKNOWN');

                // 💸 Entry Target
                preg_match('/Entry Target:\s*\$?([\d\.]+)/i', $text, $entryMatch);
                $entryTarget = $entryMatch[1] ?? null;

                // 🛑 Stop Loss
                preg_match('/SL:\s*\$?([\d\.]+)/i', $text, $slMatch);
                $stopLoss = $slMatch[1] ?? null;

                // 🎯 TP1–TP6
                preg_match_all('/\d\)\s*([\d\.]+)/', $text, $tpMatches);
                $tpPoints = $tpMatches[1] ?? [];

                // Assign to individual variables safely
                $tp1 = $tpPoints[0] ?? null;
                $tp2 = $tpPoints[1] ?? null;
                $tp3 = $tpPoints[2] ?? null;
                $tp4 = $tpPoints[3] ?? null;
                $tp5 = $tpPoints[4] ?? null;
                $tp6 = $tpPoints[5] ?? null;

                // ✅ Send detected data
                $this->bot->sendMessage([
                    'chat_id' => $chatId,
                    'text' => "📊 Coin: $coinType\n📈 Type: $tpMode\n🎯 Entry: $entryTarget\n🛑 SL: $stopLoss\n🎯 TP1: $tp1\n🎯 TP2: $tp2\n🎯 TP3: $tp3\n🎯 TP4: $tp4\n🎯 TP5: $tp5\n🎯 TP6: $tp6\n⏳ Getting live price...",
                ]);

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
                    'text' => "❌ Could not detect a valid coin pair. Please use format like BTC/USDT.",
                ]);
            }

        }

        $user->save();
        return response('ok');
    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendMessage(Request $request)
    {
        try {
            $message = $this->bot->sendMessage([
                'chat_id'      => $this->chat_id,
                'text'         => 'Welcome To Code-180 Youtube Channel',
                'reply_markup' => [
                    'inline_keyboard' => [[[
                        'text' => '@code-180',
                        'url'  => 'https://www.youtube.com/@code-180/videos',
                    ]]],
                ],
            ]);
            // $message = $this->bot->sendMessage([
            //     'chat_id' => $this->chat_id,
            //     'text'    => 'Welcome To Code-180 Youtube Channel',
            // ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendPhoto(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://anyurl/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendPhoto([
                'chat_id' => $this->chat_id,
                'photo'   => [
                    'file'     => fopen(asset('public/upload/img.jpg'), 'r'),
                    'filename' => 'demoImg.jpg',
                ],
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendAudio(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendAudio([
                'chat_id' => $this->chat_id,
                'audio'   => fopen(asset('public/upload/demo.mp3'), 'r'),
                'caption' => "Demo Audio File",
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendVideo(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendVideo([
                'chat_id' => $this->chat_id,
                'video'   => fopen(asset('public/upload/Password.mp4'), 'r'),
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendVoice(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendVoice([
                'chat_id' => $this->chat_id,
                'voice'   => fopen(asset('public/upload/demo.mp3'), 'r'),
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendDocument(Request $request)
    {
        try {
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // 1. https://picsum.photos/640
            // 2. fopen('local/file/path', 'r')
            // 3. fopen('https://picsum.photos/640', 'r'),
            // 4. new InputFile(fopen('https://picsum.photos/640', 'r'), 'test-image.jpg')
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            $message = $this->bot->sendDocument([
                'chat_id'  => $this->chat_id,
                'document' => fopen(asset('public/upload/Test_Doc.pdf'), 'r'),
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendLocation(Request $request)
    {
        try {
            $message = $this->bot->sendLocation([
                'chat_id'   => $this->chat_id,
                'latitude'  => 19.6840852,
                'longitude' => 60.972437,
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendVenue(Request $request)
    {
        try {
            $message = $this->bot->sendVenue([
                'chat_id'   => $this->chat_id,
                'latitude'  => 19.6840852,
                'longitude' => 60.972437,
                'title'     => 'The New Word Of Code',
                'address'   => 'Address For The Place',
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendContact(Request $request)
    {
        try {
            $message = $this->bot->sendContact([
                'chat_id'      => $this->chat_id,
                'photo'        => 'https://picsum.photos/640',
                'phone_number' => '1234567890',
                'first_name'   => 'Code-180',
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendPoll(Request $request)
    {
        try {
            $message = $this->bot->sendPoll([
                'chat_id'  => $this->chat_id,
                'question' => 'What is best coding language for 2023',
                'options'  => ['python', 'javascript', 'typescript', 'php', 'java'],
            ]);
        } catch (Exception $e) {
            $message = 'Message: ' . $e->getMessage();
        }
        return Response::json($message);
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

}