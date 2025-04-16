<?php
use WeStacks\TeleBot\TeleBot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


function bybitInfo($instruments, $market){
    // https://developers.coindesk.com/settings/api-keys
    $response = Http::get('https://data-api.coindesk.com/spot/v1/latest/tick', [
        'market' => $market,
        'instruments' => $instruments, //'LTC-USDT',
        "apply_mapping" => true,
        "api_key" => "c37c91234bb89ea9a136491e17c522f2cdf21d83a483ac3d897641cfd3b8f3f3"
    ]);

    if ($response->successful()) {
        $data = $response->json();
        if(isset($data["Data"][$instruments]["PRICE"])){
            $price = $data["Data"][$instruments]["PRICE"];
            return ["price" => $price, "status" => true];
        }else{
            return ["msg" => "Something went wrong, try again!", "status" => false];
        }
    } else {
        return ["msg" => $response["Err"]["message"], "status" => false];
    }
}

function bybitMultiInfo($instruments, $market){
    $response = Http::get('https://data-api.coindesk.com/spot/v1/latest/tick', [
        'market' => $market,
        'instruments' => $instruments, //'LTC-USDT',
        "apply_mapping" => true,
        "api_key" => "c37c91234bb89ea9a136491e17c522f2cdf21d83a483ac3d897641cfd3b8f3f3"
    ]);

    if ($response->successful()) {
        $data = $response->json();

        return ["price" => $data["Data"], "status" => true];
    } else {
        return ["msg" => $response["Err"]["message"], "status" => false];
    }
}

// ai 
function aiAdvisorTakeProfit($symbol, $mod, $entry, $sl, $tp_level, $current_price, $chat_id)
{
    $message = "I'm trading {$symbol} with a {$mod} position. My entry was at {$entry} with a stop loss at {$sl}.
    My take profit levels are:
    {', '.join([f'TP{i+1}: {tp}' for i, tp in enumerate(tps)])}

    The price just hit TP{$tp_level} at {$current_price}.

    Based on this information, what's the best trade management advice you can give me? Should I move my stop loss? Take partial profits? Consider the risk-reward ratio and best practices for trade management.

    Provide a concise, practical recommendation in a friendly tone.";


    $response = Http::withToken(env('OPENAI_API_KEY'))
        ->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

    if ($response->successful()) {
        $message = $response['choices'][0]['message']['content'];
        $bot = new TeleBot(env('TELEGRAM_BOT_HTTP'));
        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }
}


function aiAdvisorTakeLose($symbol, $mod, $entry, $sl, $current_price, $chat_id)
{
    $message = "I'm trading {$symbol} with a {$mod} position. My entry was at {$entry} with a stop loss at {$sl}.
    Unfortunately, the price just hit my stop loss at {$current_price}.
    Based on this information, what's the best advice you can give me? How should I handle this loss and what should I consider for future trades?
    Provide a concise, supportive recommendation in a friendly tone.";
    $response = Http::withToken(env('OPENAI_API_KEY'))
        ->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.7,
            'max_tokens' => 500,
        ]);

    if ($response->successful()) {
        $message = $response['choices'][0]['message']['content'];
        $bot = new TeleBot(env('TELEGRAM_BOT_HTTP'));
        $bot->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }
}

function stopSchedule()
{

}