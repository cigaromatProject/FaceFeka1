<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{


    public function index($user)
    {
        $user = User::findOrFail($user); // gives the ID of the user
        return view('profiles.index', [
            'user' => $user,
        ]);
    }
}
