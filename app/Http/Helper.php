<?php
use WeStacks\TeleBot\TeleBot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;



function combineCryptoPrices($details)
{
  $response = Http::get("https://msw-app.com/crypto", [
      "details" => $details
  ]);

  return $response->json();
}




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

// format 
function formatNumberFlexible($number, $decimals = 8) {
    $cleanNumber = str_replace(',', '', $number);
    $formatted = number_format((float)$cleanNumber, $decimals, '.', '');
    return rtrim(rtrim($formatted, '0'), '.');
}

// Notifications 
function getTakeProfitTemplate($trade, $hitted_tp)
{
    $template = [
        'title' => '',
        'body' => '',
        'recommendation' => '',
        'buttons' => [
            [['text' => '❌ Close Trade', 'callback_data' => "close_trade_{$trade->id}"]],
        ],
    ];

    switch ($hitted_tp) {
        case 1:
            $template['title'] = "✅ TAKE PROFIT 1 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP1] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP2]

            Your trade is still being tracked for higher targets.
            EOT;
            break;

        case 2:
            $template['title'] = "✅ TAKE PROFIT 2 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP2] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP3]

            Your trade is still being tracked for higher targets.
            EOT;
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 3:
          $template['title'] = "✅ TAKE PROFIT 3 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP3] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP4]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
        case 4:
            $template['title'] = "✅ TAKE PROFIT 4 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP4] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP5]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 5:
            $template['title'] = "🌟 TAKE PROFIT 5 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP5] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider taking partial profits now and moving stop loss to your last TP level to lock in gains.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
    }

    return $template;
}
function getTakeProfitReverseTemplate($trade, $hitted_tp)
{
    $template = [
        'title' => '',
        'body' => '',
        'recommendation' => '',
        'buttons' => [
            [['text' => '❌ Close Trade', 'callback_data' => "close_trade_{$trade->id}"]],
        ],
    ];

    switch ($hitted_tp) {
        case 1:
            $template['title'] = "🔴 Market Reversed to TP1";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP1] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP2]
            EOT;
            $template['recommendation'] = "Your trade is still being tracked for higher targets.";
            break;

        case 2:
            $template['title'] = "🔴 Market Reversed to TP2";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP2] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP3]
            EOT;
            $template['recommendation'] = "Your trade is still being tracked for higher targets.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 3:
          $template['title'] = "🔴 Market Reversed to TP3";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP3] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP4]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
        case 4:
            $template['title'] = "🔴 Market Reversed to TP4";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP4] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            Next Target: [TP5]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 5:
            $template['title'] = "🔴 Market Reversed to TP5";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP5] ← REACHED
            Current Price: [CURRENT_PRICE]
            Profit: [PROFIT]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider taking partial profits now and moving stop loss to your last TP level to lock in gains.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
    }

    return $template;
}
function aiAdvisorTakeProfit($trade, $hitted_tp, $chat_id, $reverse, $current_price, $isFinalTrade)
{
    // check template  
    if($reverse){
        $template = getTakeProfitTemplate($trade, $hitted_tp);
    }else{
        $template = getTakeProfitReverseTemplate($trade, $hitted_tp);
    }

    // int  
    $entry_point = formatNumberFlexible($trade->entry_target);
    $stop_loss = formatNumberFlexible($trade->stop_loss);
    $leverage = formatNumberFlexible(str_replace('x', '', $trade->leverage));
    $intInvestment = empty($trade->position_size_usdt) ? formatNumberFlexible($trade->position_size_coin) : formatNumberFlexible($trade->position_size_usdt);
    $intInvestmentSign = empty($trade->position_size_usdt) ? "Coin" : "USDT";
    $tp1 = formatNumberFlexible($trade->take_profit1);
    $tp2 = formatNumberFlexible($trade->take_profit2);
    $tp3 = formatNumberFlexible($trade->take_profit3);
    $tp4 = formatNumberFlexible($trade->take_profit4);
    $tp5 = formatNumberFlexible($trade->take_profit5);
    $tp5 = formatNumberFlexible($trade->take_profit5);
    $buttons = $template['buttons'];
    $tradeCloseTxt = "";

    // profit  
    $property = 'take_profit' . $hitted_tp;
    $take_profit = formatNumberFlexible($trade->$property);
    $profit = formatNumberFlexible(number_format((($take_profit - $entry_point) / $entry_point) * $leverage * 100, 0));
    $profitCount = number_format(($profit/100)*$intInvestment, 2);
    $finalProfit = "+".number_format(($profit/100)*$intInvestment, 2)."% (+$profitCount $intInvestmentSign)";

    // partial 
    $secureMsg = "";
    if($trade->profit_strategy == "partial_profits"){
        
        $secureProfit = 0;
        for ($i = 1; $i <= 5; $i++) {
            if (!is_null($trade->height_tp) && $trade->height_tp >= $i && $entry_point > 0) {
                $tpField = "take_profit{$i}";
                $tpPrice = (float) $trade->$tpField;
                $partialProperty = $trade->{"partial_profits_tp{$i}"} ?? 0;
                $percentGain = (($tpPrice - $entry_point) / $entry_point) * $leverage * 100;
                $grossProfit = ($percentGain / 100) * $intInvestment;
                $securedProfit = $partialProperty ? ($partialProperty / 100) * $grossProfit : 0;

                $secureProfit += $securedProfit;
            }
        }
        // is final trade  
        if($isFinalTrade){
            $finalRecomandation = "<b>Your final trade is complete. We are closing your trade.</b>";
            $buttons = [];
            $finalProfit = "+$secureProfit $intInvestmentSign";
        }else{
            $secureMsg = $secureProfit > 0 ? "<b>Total secured profit:</b> <code>" . number_format($secureProfit, 2) . " {$intInvestmentSign}</code>" : '';
        }
    }

    if (!$template) return;

    $replacements = [
        '[PAIR-USDT]' => $trade->instruments ?? 'PAIR-USDT',
        '[LONG/SHORT]' => strtoupper($trade->tp_mode ?? 'LONG'),
        '[CURRENT_PRICE]' => $current_price ?? 'N/A',
        '[PROFIT]' => $finalProfit ?? 'N/A',
        '[Entry]' => $entry_point ?? 'N/A',
        '[TP1]' => $tp1 ?? 'N/A',
        '[TP2]' => $tp2 ?? 'N/A',
        '[TP3]' => $tp3 ?? 'N/A',
        '[TP4]' => $tp4 ?? 'N/A',
        '[TP5]' => $tp5 ?? 'N/A',
    ];

    $text = $template['title'] . "\n\n" . str_replace(array_keys($replacements), array_values($replacements), $template['body']);

    if(!empty($finalRecomandation)){
        $recomandationTxt = $finalRecomandation;
    }else{
        $recomandationTxt = $template['recommendation'];
    }
    $text .= "\n\n$secureMsg \n$recomandationTxt";


    $messageResponse = Telegram::sendMessage([
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode(['inline_keyboard' => $buttons])
    ]);

    // add new ids  
    $trackSignalMsgIds = Cache::get("signal_notification_ids_$trade->id");
    $trackSignalMsgIds[] = $messageResponse->getMessageId();
    Cache::forever("signal_notification_ids_$trade->id", $trackSignalMsgIds);

    $trade->profit_loss = "profit";
    $trade->save();
}

function aiAdvisorTakeLose($trade, $chat_id)
{
    $entry_point = formatNumberFlexible($trade->entry_target);
    $stop_loss = formatNumberFlexible($trade->stop_loss);

    // int  
    $leverage = formatNumberFlexible(str_replace('x', '', $trade->leverage));
    $intInvestment = empty($trade->position_size_usdt) ? formatNumberFlexible($trade->position_size_coin) : formatNumberFlexible($trade->position_size_usdt);
    $intInvestmentSign = empty($trade->position_size_usdt) ? "Coin" : "USDT";

    // profit 
    $profit = formatNumberFlexible(number_format((($stop_loss - $entry_point) / $entry_point) * $leverage * 100, 0));
    $profitCount = (($profit/100)*$intInvestment);

    // partial 
    $secureProfit = 0;
    if($trade->profit_strategy == "partial_profits"){
        for ($i = 1; $i <= 5; $i++) {
            if (!is_null($trade->height_tp) && $trade->height_tp >= $i && $entry_point > 0) {
                $tpField = "take_profit{$i}";
                $tpPrice = (float) $trade->$tpField;
                $partialProperty = $trade->{"partial_profits_tp{$i}"} ?? 0;
                $percentGain = (($tpPrice - $entry_point) / $entry_point) * $leverage * 100;
                $grossProfit = ($percentGain / 100) * $intInvestment;
                $securedProfit = $partialProperty ? ($partialProperty / 100) * $grossProfit : 0;
    
                $secureProfit += $securedProfit;
            }
        }
    }
    $finalResult = $profitCount + $secureProfit;
    
    if($finalResult < 1){
        $resultTxt = "The trade was closed with a loss.";
        $showingResult = "-".$finalResult;
    }else{
        $resultTxt = "The trade was closed with a win.";
        $showingResult = "+".$finalResult;
    }

    Telegram::sendMessage([
        'chat_id' => $chat_id,
        'text' => <<<EOT
        ❌ STOP LOSS HIT!

        $trade->instruments $trade->tp_mode
        Entry: $entry_point
        Stop Loss: $stop_loss ← REACHED
        Result: {$showingResult} {$intInvestmentSign}

        {$resultTxt}
        $trade->tp_mode trade has been closed and moved to history.
        EOT,
        'parse_mode' => 'HTML',
    ]);

    $trade->trade_exit = date('d, m, y m:h a');
    $trade->profit_loss = "loss";
    $trade->save();
}
function startWaitingTrade($trade, $current_price, $chat_id)
{
    $mode = strtoupper($trade->tp_mode);
    $entry_point = formatNumberFlexible($trade->entry_target);
    $stop_loss = formatNumberFlexible($trade->stop_loss);
    $tp1 = formatNumberFlexible($trade->take_profit1);
    $tp2 = formatNumberFlexible($trade->take_profit2);
    $tp3 = formatNumberFlexible($trade->take_profit3);
    $tp4 = formatNumberFlexible($trade->take_profit4);
    $tp5 = formatNumberFlexible($trade->take_profit5);

    $messageResponse = Telegram::sendMessage([
        'chat_id' => $chat_id,
        'text' => <<<EOT
        🎯 ENTRY POINT REACHED!

        $trade->instruments $mode
        Entry: $entry_point ← REACHED

        Your signal is now active and being tracked.
        Current Price: $current_price
        Stop Loss: $stop_loss

        <b>Take Profit Targets:</b>
        🎯 TP1: $tp1
        🎯 TP2: $tp2
        🎯 TP3: $tp3
        🎯 TP4: $tp4
        🎯 TP5: $tp5

        I'll continue monitoring and alert you when any price targets are reached.
        EOT,
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [
                    ['text' => '❌ Close Trade', 'callback_data' => "close_trade_$trade->id"],
                ]
            ]
        ])
    ]);

    // add new ids  
    $trackSignalMsgIds = Cache::get("signal_notification_ids_$trade->id");
    $trackSignalMsgIds[] = $messageResponse->getMessageId();
    Cache::forever("signal_notification_ids_$trade->id", $trackSignalMsgIds);

    $trade->trade_entry = date('d, m, y m:h a');
    $trade->save();
}