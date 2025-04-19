<?php

namespace App\Console\Commands;

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
    protected $signature = 'run:schedule-crypto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    // public function handle()
    // {
    //     // get latest runing trades 
    //     $schedules = ScheduleCrypto::latest()
    //     ->where("status", "running")
    //     ->get()
    //     ->groupBy('market');

    //     // Format:
    //     $groupedInstruments = $schedules->map(function ($group) {
    //         return $group->pluck('instruments')
    //             ->map(fn($item) => strtoupper($item)) // make uppercase
    //             ->unique()
    //             ->values();
    //     });

    //     // collect all market prices 
    //     $prices = [];
    //     foreach ($groupedInstruments as $key => $instrumentLists) {
    //         $instrumentString = collect($instrumentLists)->implode(',');
    //         $bybitInfo = bybitMultiInfo($instrumentString, $key);
    //         if ($bybitInfo["status"]) {
    //             $price = collect($bybitInfo['price'])
    //             ->mapWithKeys(function ($item, $key) {
    //                 return [$key => number_format($item['PRICE'], 2)];
    //             })
    //             ->toArray();

    //             $prices[$key] = $price;
    //         }
    //     }


    //     // notify to users  
    //     $scheduleUserss = ScheduleCrypto::latest()
    //     ->where("status", "running")
    //     ->get();
    //     foreach ($scheduleUserss as $value) {
    //         $currentPrice = (int)$prices[$value->market][$value->instruments];
    //         $chat_id = $value->chat_id;
    //         $mod = $value->tp_mode;
    //         $entry_target = (int)$value->entry_target;
    //         $instruments = $value->instruments;
    //         $sl = (int)$value->stop_loss;
    //         $tp1 = (int)$value->take_profit1;
    //         $tp2 = (int)$value->take_profit2;
    //         $tp3 = (int)$value->take_profit3;
    //         $tp4 = (int)$value->take_profit4;
    //         $tp5 = (int)$value->take_profit5;
    //         $tp6 = (int)$value->take_profit6;

    //         // notify for sl 
    //         if($mod == "LONG"){
    //             // stop lose 
    //             if($currentPrice < $sl){
    //                 aiAdvisorTakeLose($instruments, $mod, $entry_target, $sl, $currentPrice, $chat_id);
    //             }

    //             // take profit 
    //             else if($currentPrice > $tp1 && $currentPrice > $tp2){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 1, $currentPrice, $chat_id);
    //             }else if($currentPrice > $tp2 && $currentPrice > $tp3){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 2, $currentPrice, $chat_id);
    //             }else if($currentPrice > $tp3 && $currentPrice > $tp4){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 3, $currentPrice, $chat_id);
    //             }else if($currentPrice > $tp4 && $currentPrice > $tp5){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 4, $currentPrice, $chat_id);
    //             }else if($currentPrice > $tp5 && $currentPrice > $tp6){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 5, $currentPrice, $chat_id);
    //             }else if($currentPrice > $tp6){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 6, $currentPrice, $chat_id);
    //             }else{
    //                 stopSchedule($value->id);
    //             }

    //         }
            
    //         else{
    //             // stop lose 
    //             if($currentPrice > $sl){
    //                 aiAdvisorTakeLose($instruments, $mod, $entry_target, $sl, $currentPrice, $chat_id);
    //             }

    //             // take profit 
    //             else if($currentPrice < $tp1 && $currentPrice < $tp2){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 1, $currentPrice, $chat_id);
    //             }else if($currentPrice < $tp2 && $currentPrice < $tp3){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 2, $currentPrice, $chat_id);
    //             }else if($currentPrice < $tp3 && $currentPrice < $tp4){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 3, $currentPrice, $chat_id);
    //             }else if($currentPrice < $tp4 && $currentPrice < $tp5){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 4, $currentPrice, $chat_id);
    //             }else if($currentPrice < $tp5 && $currentPrice < $tp6){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 5, $currentPrice, $chat_id);
    //             }else if($currentPrice < $tp6){
    //                 aiAdvisorTakeProfit($instruments, $mod, $entry_target, $sl, 6, $currentPrice, $chat_id);
    //             }else{
    //                 stopSchedule($value->id);
    //             }
    //         }
    //     }
    // }



    public function handle()
    {
        // Get all latest running trades
        $schedules = ScheduleCrypto::latest()
            ->where("status", "running")
            ->get();

        // Group instruments by market & format them
        $groupedInstruments = $schedules->groupBy('market')->map(function ($group) {
            return $group->pluck('instruments')
                ->map(fn($item) => strtoupper($item))
                ->unique()
                ->values();
        });

        // Collect all market prices
        $prices = [];
        foreach ($groupedInstruments as $market => $instrumentList) {
            $instrumentString = $instrumentList->implode(',');
            $bybitInfo = bybitMultiInfo($instrumentString, $market);

            if ($bybitInfo["status"]) {
                $prices[$market] = collect($bybitInfo['price'])
                    ->mapWithKeys(fn($item, $key) => [$key => number_format($item['PRICE'], 2)])
                    ->toArray();
            }
        }

        // Notify users
        foreach ($schedules as $trade) {
            $instrument = $trade->instruments;
            $market = $trade->market;
            $currentPrice = isset($prices[$market][$instrument]) ? (float)$prices[$market][$instrument] : null;

            if (is_null($currentPrice)) continue;

            $chatId = $trade->chat_id;
            $mode = strtoupper($trade->tp_mode);
            $entry = (float)$trade->entry_target;
            $sl = (float)$trade->stop_loss;

            $tpLevels = collect([
                $trade->take_profit1,
                $trade->take_profit2,
                $trade->take_profit3,
                $trade->take_profit4,
                $trade->take_profit5,
                $trade->take_profit6,
            ])->map(fn($tp) => (float)$tp);

            // Check SL and TP
            $slHit = $mode === 'LONG' ? $currentPrice < $sl : $currentPrice > $sl;

            if ($slHit) {
                aiAdvisorTakeLose($instrument, $mode, $entry, $sl, $currentPrice, $chatId);
                continue;
            }

            $tpTriggered = false;

            foreach ($tpLevels as $index => $tp) {
                $condition = $mode === 'LONG'
                    ? $currentPrice > $tp
                    : $currentPrice < $tp;

                if ($condition) {
                    aiAdvisorTakeProfit($instrument, $mode, $entry, $sl, $index + 1, $currentPrice, $chatId);
                    $tpTriggered = true;
                }
            }

            if (!$tpTriggered) {
                stopSchedule($trade->id);
            }
        }
    }

}
