@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://www.afeka.ac.il/media/8703/051006096.jpg?width=153&height=153&mode=crop" class="rounded-circle">

        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline"><h1>{{$user->name}}</h1>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>

            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex">
            <div class="pr-5"><strong>258</strong> friends</div>
            <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> photos</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="https://portal.afeka.ac.il">{{$user->profile->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" class="w-100">
                </a>
                <i>{{ $post->text }}</i>
            </div>

        @endforeach

        </div>
    </div>

</div>
@endsection
