<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{

    public function index(User $user)
    {
        return view('profiles.index', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        // Authorize this action
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        // Authorize this action
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => '',
            'description' => '',
            'url' => 'url',
            'image' => ''
        ]);

        auth()->user->profile->update($data); // protection

        return redirect("/profile/{$user->id}");
    }
}
