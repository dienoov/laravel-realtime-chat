<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        return response([
            'messages' => Message::with('user')->get(),
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string'],
        ]);

        $input = \request(['message']);

        $message = $request->user()->messages()->create($input);

        broadcast(new MessageEvent($message->load('user')));

        return response([
            'message' => 'success',
        ]);
    }
}
