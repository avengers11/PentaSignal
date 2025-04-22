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
  $formatted = number_format((float)$number, $decimals, '.', '');
  return rtrim(rtrim($formatted, '0'), '.');
}

// Notifications 
// TakeProfitTemplates.php

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
            Next Target: [TP4]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
        case 4:
            $template['title'] = "✅ TAKE PROFIT 3 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP4] ← REACHED
            Next Target: [TP5]
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider moving your stop loss to break-even (entry point) to secure your trade profits.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;

        case 5:
            $template['title'] = "🌟 TAKE PROFIT 4 REACHED!";
            $template['body'] = <<<EOT
            [PAIR-USDT] [LONG/SHORT]
            Entry: [Entry]
            TP: [TP5] ← REACHED
            EOT;
            $template['recommendation'] = "🔒 RECOMMENDATION: Consider taking partial profits now and moving stop loss to your last TP level to lock in gains.";
            $template['buttons'][] = [['text' => '⚙️ Update Stop Loss', 'callback_data' => "update_trade_stop_loss_{$trade->id}"]];
            break;
    }

    return $template;
}
function aiAdvisorTakeProfit($trade, $hitted_tp, $chat_id)
{
    $template = getTakeProfitTemplate($trade, $hitted_tp);
    if (!$template) return;

    $replacements = [
        '[PAIR-USDT]' => $trade->instruments ?? 'PAIR-USDT',
        '[LONG/SHORT]' => strtoupper($trade->tp_mode ?? 'LONG'),
        '[Entry]' => $trade->entry_target."$" ?? 'N/A',
        '[TP1]' => $trade->take_profit1."$" ?? 'N/A',
        '[TP2]' => $trade->take_profit2."$" ?? 'N/A',
        '[TP3]' => $trade->take_profit3."$" ?? 'N/A',
        '[TP4]' => $trade->take_profit4."$" ?? 'N/A',
        '[TP5]' => $trade->take_profit5."$" ?? 'N/A',
    ];

    $text = $template['title'] . "\n\n" . str_replace(array_keys($replacements), array_values($replacements), $template['body']);

    if (!empty($template['recommendation'])) {
        $text .= "\n\n" . $template['recommendation'];
    }

    $messageResponse = Telegram::sendMessage([
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML',
        'reply_markup' => json_encode(['inline_keyboard' => $template['buttons']])
    ]);


    // add new ids  
    $trackSignalMsgIds = Cache::get("signal_notification_ids_$trade->id");
    $trackSignalMsgIds[] = $messageResponse->getMessageId();
    Cache::forever("signal_notification_ids_$trade->id", $trackSignalMsgIds);
}

function aiAdvisorTakeLose($trade, $chat_id)
{
    if($trade->type == "real"){
      Telegram::sendMessage([
          'chat_id' => $chat_id,
          'text' => <<<EOT
          ❌ STOP LOSS HIT!

          $trade->instruments $trade->tp_mode
          Entry: $trade->entry_target$
          Stop Loss: $trade->stop_loss$ ← REACHED

          Trade closed with a loss.

          Feel free to share your trade results or skip if you prefer.
          EOT,
          'parse_mode' => 'HTML',
          'reply_markup' => json_encode([
              'inline_keyboard' => [
                  [
                      ['text' => '📈 Provide Trade Report', 'callback_data' => "trade_report_loss_$trade->id]"],
                  ]
              ]
          ])
      ]);
    }else{
      Telegram::sendMessage([
          'chat_id' => $chat_id,
          'text' => <<<EOT
          ❌ STOP LOSS HIT!

          $trade->instruments $trade->tp_mode
          Entry: $trade->entry_target$
          Stop Loss: $trade->stop_loss$ ← REACHED

          Trade closed with a loss.

          Demo trade has been closed and moved to history.
          EOT,
          'parse_mode' => 'HTML',
      ]);
    }
}
function startWaitingTrade($trade, $current_price, $chat_id)
{
  $mode = strtoupper($trade->tp_mode);

  $messageResponse = Telegram::sendMessage([
      'chat_id' => $chat_id,
      'text' => <<<EOT
      🎯 ENTRY POINT REACHED!

      $trade->instruments $mode
      Entry: $trade->entry_target$ ← REACHED

      Your signal is now active and being tracked.
      Current Price: $current_price$
      Stop Loss: $trade->stop_loss$

      <b>Take Profit Targets:</b>
      🎯 TP1: $trade->take_profit1$
      🎯 TP2: $trade->take_profit2$
      🎯 TP3: $trade->take_profit3$
      🎯 TP4: $trade->take_profit4$
      🎯 TP5: $trade->take_profit5$

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
}