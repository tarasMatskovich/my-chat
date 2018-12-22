<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Http\Resources\MessageResource;
use App\Models\Session;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {

    }

    public function message($id)
    {
        $user2 = User::findOrFail($id);
        $session = Session::where(['user1_id' => $id, 'user2_id' => auth()->id()])
            ->orWhere(['user1_id'=>auth()->id(), 'user2_id' => $id])->first();


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
}
