<?php

use App\Http\Controllers\ChatController;
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

Route::get('/user2',function(){
    event(new \App\Events\BattleEvent());
    // event(new \App\Events\GroundEvent());
    return ["message"=>"Message sent Successfully"];
});

Route::get('/ws', function (){
    return view('websocket');
});

Route::get('/chat',[ChatController::class,'chatIndex']);
Route::post('/broad-cast',[ChatController::class,'broadCastMessage'])->name('broadCastMessage');
