<?php

namespace App\Console\Commands;

use App\Models\Setting;
use WeStacks\TeleBot\TeleBot;
use App\Models\ScheduleCrypto;
use Illuminate\Console\Command;
use App\Jobs\ScheduleTakeLoseJob;
use Illuminate\Support\Facades\Log;

class ScheduleCryptoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:schedule-crypto'; // php artisan run:schedule-crypto
    protected $description = 'Command description';
    public function handle()
    {
        // Log::info("Cron called");

        // Get all latest running trades
        $schedules = ScheduleCrypto::latest()
        ->whereIn("status", ["running", "waiting"])
        ->get();


        // Group instruments by market & format them
        $groupedInstruments = $schedules->groupBy('market')->map(function ($group) {
            return $group->pluck('instruments')
                ->map(fn($item) => str_replace('-', '', strtoupper($item)))
                ->unique()
                ->values();
        })->toArray();

        // Log::info($groupedInstruments);

        /*
        Price Ex:
        */
        $combainData = combineCryptoPrices($groupedInstruments);

        $setting = Setting::where("key", "crypto_data")->first();
        $setting->value = $combainData;
        $setting->save();

        // $combainData = [
        //     "binance" => [
        //         "LTCUSDT" => '75.9'
        //     ],
        //     "bybit" => [
        //         "BTCUSDT" => '78.81'
        //     ]
        // ];
        // Log::info($combainData);
        
        // return;
        // Notify users
        foreach ($schedules as $trade) {
            $instrument = str_replace('-', '', strtoupper($trade->instruments));
            $market = $trade->market;
            $currentPrice = isset($combainData[$market][$instrument]) ? formatNumberFlexible($combainData[$market][$instrument]) : null;
            

            if (is_null($currentPrice)) continue;

            $chatId = $trade->chat_id;
            $mode = strtoupper($trade->tp_mode);
            $entry = formatNumberFlexible($trade->entry_target);
            $sl = formatNumberFlexible($trade->stop_loss);


            Log::info([
                "id" => $trade->id,
                "currentP" => $currentPrice,
                "stop" => formatNumberFlexible($trade->stop_loss),
            ]);

            #ALERT 1
            // Check if the trade is in waiting status
            if ($trade->status === "waiting") {
                $shouldStart = ($mode === 'LONG' && $currentPrice < $entry) || ($mode === 'SHORT' && $currentPrice > $entry);
                if ($shouldStart) {
                    startWaitingTrade($trade, $currentPrice, $chatId);

                    $trade->status = "running";
                    $trade->save();
                }
                continue;
            }

            #ALERT 2
            // Check SL hit
            $slHit = $mode === 'LONG' ? $currentPrice < $sl : $currentPrice > $sl;
            if ($slHit) {
                $trade->last_alert = "sl";
                $trade->status = "closed";
                $trade->save();
                aiAdvisorTakeLose($trade, $chatId);
                continue;
            }

            #ALERT 3
            $tpLevels = collect([
                $trade->take_profit1,
                $trade->take_profit2,
                $trade->take_profit3,
                $trade->take_profit4,
                $trade->take_profit5
            ])->map(fn($tp) => formatNumberFlexible($tp));

            // any profit hit  
            for ($i = 4; $i >= 0; $i--) {
                $tp = $tpLevels[$i];
                $tp_level = $i + 1;
                $condition = $mode === 'LONG' ? $currentPrice > $tp : $currentPrice < $tp;

                if ($condition) {
                    $tpLevelStatus = "tp_" . $tp_level;
                    if ($tpLevelStatus !== $trade->last_alert) {
                        // fix the height tp 
                        if(formatNumberFlexible($trade->height_tp) < formatNumberFlexible($tp_level)){
                            $trade->height_tp = $tp_level;
                        }
                        $trade->last_alert = $tpLevelStatus;
                        $trade->save();

                        // remove old message 
                        $allTelegramMsgIds = Cache::get("signal_notification_ids_$trade->id");
                        if (!empty($allTelegramMsgIds)) {
                            foreach ($allTelegramMsgIds as $messageId) {
                                try {
                                    Telegram::deleteMessage([
                                        'chat_id' => $chatId,
                                        'message_id' => $messageId,
                                    ]);
                                } catch (\Telegram\Bot\Exceptions\TelegramResponseException $e) {
                                    Log::warning("Failed to delete Telegram message ID: $messageId. Reason: " . $e->getMessage());
                                }
                            }
                        }
                        // Forget the cached message IDs after deleting
                        Cache::forget("signal_notification_ids_$trade->id");

                        aiAdvisorTakeProfit($trade, $tp_level, $chatId);
                    }
                    break;
                }
            }

        }
    }

}
