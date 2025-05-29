<?php

use App\Events\PodcastProcessed;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {

    // event(new PodcastProcessed('Foisal Ahmed', 'foisal@gmail.com', '2025-05-24 15:34:41', '12345678', Str::random(10)));

    return view('welcome');
});

Route::get('/message', [App\Http\Controllers\BroadcastController::class, 'sendMessage'] );
Route::get('/chat', [App\Http\Controllers\BroadcastController::class, 'chat'] );


Route::get('/pusher-index', [App\Http\Controllers\PusherController::class, 'index'] );
Route::post('/broadcast', [App\Http\Controllers\PusherController::class, 'broadcast'] );
Route::post('/receive', [App\Http\Controllers\PusherController::class, 'receive'] );
