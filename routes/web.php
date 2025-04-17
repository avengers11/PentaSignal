<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//+++++++++++++++++++++++++++++
Route::get('sendMessage', [App\Http\Controllers\TelegramBotController::class, 'sendMessage']);
Route::get('sendPhoto', [App\Http\Controllers\TelegramBotController::class, 'sendPhoto']);
Route::get('sendAudio', [App\Http\Controllers\TelegramBotController::class, 'sendAudio']);
Route::get('sendVideo', [App\Http\Controllers\TelegramBotController::class, 'sendVideo']);
Route::get('sendVoice', [App\Http\Controllers\TelegramBotController::class, 'sendVoice']);
Route::get('sendDocument', [App\Http\Controllers\TelegramBotController::class, 'sendDocument']);
Route::get('sendLocation', [App\Http\Controllers\TelegramBotController::class, 'sendLocation']);
Route::get('sendVenue', [App\Http\Controllers\TelegramBotController::class, 'sendVenue']);
Route::get('sendContact', [App\Http\Controllers\TelegramBotController::class, 'sendContact']);
Route::get('sendPoll', [App\Http\Controllers\TelegramBotController::class, 'sendPoll']);
Route::any('telegram-message-webhook', [App\Http\Controllers\TelegramBotController::class, 'telegram_webhook']);
Route::get('bybit-info', [App\Http\Controllers\TelegramBotController::class, 'bybitInfo']);

// webapp 
Route::controller(App\Http\Controllers\TelegramBotController::class)->prefix("web-app")->group(function(){
    Route::get('custom-partial', 'customPartial');
});