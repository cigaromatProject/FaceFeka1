@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://www.afeka.ac.il/media/8703/051006096.jpg?width=153&height=153&mode=crop" class="rounded-circle">

        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline"><h1>{{$user->name}}</h1>
                <a href="/p/create">Add New Post</a>
            </div>
            <div class="d-flex">
            <div class="pr-5"><strong>253</strong> friends</div>
            <div class="pr-5"><strong>113</strong> photos</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="https://portal.afeka.ac.il">{{$user->profile->url ?? 'Afeka Homepage'}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </div>

        @endforeach

        </div>
    </div>

</div>
@endsection
