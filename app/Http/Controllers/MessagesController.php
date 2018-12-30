<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatEvent;
use App\Events\SessionEvent;
use App\Http\Resources\MessageResource;
use App\Models\Session;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\MsgReadEvent;

class MessagesController extends Controller
{
    public function index()
    {

    }

    public function read(Session $session)
    {
        $chats = $session->chats()->where('read_at', null)->where('type', 0)->where('user_id', '!=', auth()->id())->get();
        foreach ($chats as $chat) {
            $chat->update(['read_at' => Carbon::now()]);
            broadcast(new MsgReadEvent(new MessageResource($chat), $chat->session_id));
        }
    }

    public function message($id)
    {
        $user2 = User::findOrFail($id);
        $session = Session::where(['user1_id' => auth()->id(), 'user2_id' => $id])->orWhere(function($query) use ($id) {
            $query->where(['user2_id' => auth()->id(), 'user1_id' => $id]);
        })->first();


        // if session between two users does not exist - create a new session
        if (!$session) {
            $session = Session::create(['user1_id' => auth()->id(), 'user2_id' => $id]);
            broadcast(new SessionEvent($session, auth()->id()));
        }

        return view('message', ['session' => $session, 'user2' => $user2]);
    }

    public function chats(Session $session)
    {
        return MessageResource::collection($session->chats()->where('user_id', auth()->id())->get());
    }

    public function send(Session $session, Request $request)
    {
        $message = $session->messages()->create(['content' => $request->msg_content]);
        $chat = $message->createForSend($session->id, auth()->id());
        $message->createForReceive($session->id, $request->to_user);
        broadcast(new PrivateChatEvent($message->content, $chat, $chat->user));
        return response($chat->id, 200);
    }
}
