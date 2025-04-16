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
            $table->string('take_profit1')->nullable();
            $table->string('take_profit2')->nullable();
            $table->string('take_profit3')->nullable();
            $table->string('take_profit4')->nullable();
            $table->string('take_profit5')->nullable();
            $table->string('take_profit6')->nullable();
            $table->string('status')->nullable();
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
