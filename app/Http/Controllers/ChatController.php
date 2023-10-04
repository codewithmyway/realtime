<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageEvent;

class ChatController extends Controller
{
    public function chatIndex(){
    return view('chat');
    }

    public function broadCastMessage(Request $request){
        event(new MessageEvent($request->username,$request->message,$request->time));
    }
}
