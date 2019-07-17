<?php

namespace App\Http\Controllers;

use App\Post;
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
            'image' => 'image',
            'ispublic' => 'required'
        ]);

        switch ($data['ispublic']) {
            case 'Public':
                $postVisability = 1;
                break;
            case 'Private':
                $postVisability = 0;
        }

        if (request('image') && request('image2')) {
            $imagePath = request('image')->store('uploads', 'public'); // Specifies where the uploaded file would be saved - '
            //uploads directory inside storage/app/public and saves the file path
            $imagePath2 = request('image2')->store('uploads', 'public');

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200,1200);
            $image->save();

            // Get the authenticated user and add his id to the post and create a new post
            auth()->user()->posts()->create([
                'text' => $data['text'],
                'image' => $imagePath, // saves the image path in DB
                'image2' => $imagePath2,
                'ispublic' => $postVisability
            ]);
        } else if (request('image2')) {
            $imagePath = request('image2')->store('uploads', 'public'); // Specifies where the uploaded file would be saved - '
            auth()->user()->posts()->create([
                'text' => $data['text'],
                'image2' => $imagePath, // saves the image path in DB
                'ispublic' => $postVisability
            ]);
        } else if (request('image')) {
            $imagePath = request('image')->store('uploads', 'public');
            auth()->user()->posts()->create([
                'text' => $data['text'],
                'image' => $imagePath, // saves the image path in DB
                'ispublic' => $postVisability
                ]);
        } else { // a post with no image
            auth()->user()->posts()->create([
                'text' => $data['text'],
                'ispublic' => $postVisability
            ]);
        }

        // redirect - where we should go now? to user's profile
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->paginate(7);

        return view('posts.index', compact('posts'));
    }
}
