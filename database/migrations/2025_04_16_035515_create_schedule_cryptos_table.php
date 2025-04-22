<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_cryptos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_id')->nullable();
            $table->string('instruments')->nullable();
            $table->string('tp_mode')->nullable();
            $table->string('market')->nullable();
            $table->string('entry_target')->nullable();
            $table->string('stop_loss')->nullable();
            $table->string('profit_loss')->nullable();
            $table->string('leverage')->nullable();
            $table->string('take_profit1')->nullable();
            $table->string('take_profit2')->nullable();
            $table->string('take_profit3')->nullable();
            $table->string('take_profit4')->nullable();
            $table->string('take_profit5')->nullable();
            $table->string('profit_strategy')->nullable();
            $table->string('partial_profits_tp1')->nullable();
            $table->string('partial_profits_tp2')->nullable();
            $table->string('partial_profits_tp3')->nullable();
            $table->string('partial_profits_tp4')->nullable();
            $table->string('partial_profits_tp5')->nullable();
            $table->string('specific_tp')->nullable();
            $table->string('position_size_usdt')->nullable();
            $table->string('position_size_coin')->nullable();
            $table->string('height_tp')->nullable();
            $table->string('last_alert')->nullable();
            $table->string('status')->nullable(); 
            $table->string('type')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_cryptos');
    }
};
