
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-300">
        </div>
        <div class="col-4">
            <h3>{{ $post->text }}</h3>
        </div>
    </div>
</div>
@endsection
