<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => $request->input('message')]);
    }

    public function chat()
    {
        return view('chat');
    }
}