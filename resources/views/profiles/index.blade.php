
@extends('layouts.app')

@section('content')
<script>
    var playerName = '{{ $user->name }}';

</script>
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <h1>{{$user->name}}</h1>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex">
            <div class="pr-5"><strong>{{ $user->profile->followers->count() }}</strong> followers</div>
            <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $user->following->count() }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            @if (Auth::user()->id == $user->id)
            <div class="pt-2">
                <button id="gameLauncher" onClick="playFlappy('http://localhost:5000', playerName)" class="btn btn-primary" rel="noopener noreferrer" >Play Flappy Bird</button>
            </div>
            @endif
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            @if ($post->ispublic == 1 || Auth::user()->id == $user->id)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    @if ($post->image)
                    <img src="/storage/{{ $post->image }}" class="w-100">
                    @endif
                    @if ($post->image2)
                    <img src="/storage/{{ $post->image2 }}" class="w-100">
                    @endif
                        <i>{{ $post->text }}</i>
                </a>
            </div>
            @endif
        </div>
    @endforeach
    </div>

</div>
<script>
    function playFlappy(url, playerName) {
        var win = window.open(url, "_blank");
        win.playerName = playerName;
        localStorage.setItem("name", playerName);
        console.log("saved in localStorage: " + localStorage.getItem("name"));
    }


</script>

@endsection
