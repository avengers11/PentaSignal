<?php

namespace App\Console\Commands;

use App\Models\ScheduleCrypto;
use Illuminate\Console\Command;
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
    public function handle()
    {
        $schedules = ScheduleCrypto::latest()->where("status", "running")->get();
        $instrumentLists = $schedules->pluck("instruments")
        ->map(fn($item) => strtoupper($item))
        ->unique()
        ->values()
        ->implode(',');
        
        Log::info($instrumentLists);
    }
}
