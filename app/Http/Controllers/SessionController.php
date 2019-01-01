<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    private function getUserSessions()
    {
        $sessions = SessionResource::collection(Session::has("chats")->where(['user1_id' => auth()->id()])
            ->orWhere(['user2_id' => auth()->id()])->get());
        return $sessions;
    }

    public function index()
    {
        $sessions = $this->getUserSessions();
        return $sessions;
    }

    public function unread(Request $request)
    {
        $sessions = $this->getUserSessions();
        $unreadCount = 0;
        foreach($sessions->toArray($request) as $session) {
            $unreadCount += $session['unreadCount'];
        }
        return response([
            'unreadCount' => $unreadCount
        ]);
    }

    public function test(Request $request)
    {
        dd($this->getUserSessions()->toArray($request));
    }
}
