<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = SessionResource::collection(Session::where(['user1_id' => auth()->id()])
            ->orWhere(['user2_id' => auth()->id()])->get());

        return $sessions;
    }
}
