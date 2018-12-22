<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Models\Session;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {

    }

    public function message($id)
    {
        $session = Session::where(['user1_id' => $id, 'user2_id' => auth()->id()])
            ->orWhere(['user1_id'=>auth()->id(), 'user2_id' => $id])->first();


        // if session between two users does not exist - create a new session
        if (!$session) {
            $session = Session::create(['user1_id' => auth()->id(), 'user2_id' => $id]);
            broadcast(new SessionEvent($session, auth()->id()));
        }


        return view('message', ['session' => $session]);
    }
}
