<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{


    public function index($user)
    {
        $user = User::find($user); // gives the ID of the user
        return view('home', [
            'user' => $user,
        ]);
    }
}
