<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // this route will require authorization so it is protected
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        // validate the request
        $data = request()->validate([
            'text' => 'required',
            // images are not a required field
            'image' => 'image'
        ]);

        try {
            $imagePath = request('image')->store('uploads', 'public'); // Specifies where the uploaded file would be saved - '
            //uploads directory inside storage/app/public a
            //and saves the file path

         //   $image = Image::make(public_path("storage/{$imagePath}"))->fit(450, 450); // wrap & fit the image
          //  $image->save();

        } catch (Exception $f) {
            echo "exception caught";
        }
        // Get the authenticated user and add his id to the post
        auth()->user()->posts()->create([
            'text' => $data['text'],
            'image' => $imagePath //--> add this after an image column is added to the table
        ]);

        // redirect - where we should go now? to user's profile
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
