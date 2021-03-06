@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-8 off-2">
                    <div class="row">
                        <h1>Edit Profile</h1>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Text</label>
                        <input id="title"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               value="{{ old('title') ?? $user->profile->title }}" autocomplete="title" autofocus>

                        @error('text')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label">Description</label>
                        <input id="description"
                               type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description"
                               value="{{ $user->profile->description ?? old('description') }}" autocomplete="Description" autofocus>

                        @error('text')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <label for="image" class="col-md-4 col-form-label">Upload Profile Image</label>
                <input type="file" class="form-control-file" id="image" name="image">

                @error('image')
                <strong>{{ $message }}</strong>
                @enderror


            </div>

            <div class="row pt-4">
                <button class="btn btn-primary">Save Profile</button>
            </div>

        </form>

    </div>
@endsection
