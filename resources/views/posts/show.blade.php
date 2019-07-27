
@extends('layouts.app')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

@section('content')
<div class="container">
    <div class="row">
        @if($post->image)
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        @endif
        @if($post->image2)
        <div class="col-8">
            <img src="/storage/{{ $post->image2 }}" class="w-100">
        </div>
        @endif
        <div class="col-4">
            <div class="d-flex align-items-center">
                <div class="pr-3">
                    <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-40" style="max-width: 40px;">
                </div>
                <div>
                    <div class="font-weight-bold"><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->name }}</span></a>
                    @if(!$post->user->profile->followers->contains(Auth::user()))
                        <a href="#" class="pl-3">Follow</a>
                    @endif
                    </div>
                </div>
            </div>

            <hr>

            <p>{{ $post->text }}</p>
        </div>



        <div class="pt-2">
           @if($post->user->id == Auth::user()->id)
                <a href="/p/{{ $post->id }}/edit">Edit Post</a>
            @endif
        </div>


    </div>
    <div class="row-4 pt-3">
        <h3>Comments</h3>
        @if (Auth::check())
            {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
            <p>{{ Form::textarea('body', old('body')) }}</p>
            {{ Form::hidden('post_id', $post->id) }}
            <p>{{ Form::submit('Send') }}</p>
            {{ Form::close() }}
        @endif
        @forelse ($post->comments as $comment)
            <p>{{ $comment->user->name }} {{$comment->created_at}}</p>
            <p>{{ $comment->body }}</p>
            <hr>
        @empty
            <p>This post has no comments</p>
        @endforelse
</div>
@endsection


