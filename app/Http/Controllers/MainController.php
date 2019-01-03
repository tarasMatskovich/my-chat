<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    const USERS_PER_PAGE = 3;

    public function index()
    {
        $users = User::limit(self::USERS_PER_PAGE)->get();
        return view('home', ['users' => $users, 'usersPerPage' => self::USERS_PER_PAGE]);
    }
}
