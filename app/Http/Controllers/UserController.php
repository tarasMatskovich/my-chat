<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const USERS_PER_PAGE = 3;

    public function user(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('user', ['user' => $user]);
    }

    public function users(Request $request)
    {
        $users = UserResource::collection(User::offset(($request->page - 1) * self::USERS_PER_PAGE)->limit(self::USERS_PER_PAGE)->get());
        return [
            'users' => $users,
            'totalUsers' => User::count()
        ];
    }
}
