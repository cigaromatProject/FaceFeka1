<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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

        if (request('image')) { // check if the request has an image
            // --> sometimes the user may click on Save Profile without uploading an image so let him keep his old image
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(350, 350);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

            auth()->user()->profile->update(array_merge(
                $data,
                $imageArray ?? [] // display the uploaded image if updated, otherwise take no action
            )); // protection


        return redirect("/profile/{$user->id}");
    }
}
