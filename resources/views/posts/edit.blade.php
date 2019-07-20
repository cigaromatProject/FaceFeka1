@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/p/{{ $user->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-8 off-2">
                    <div class="row">
                        <h1>Edit Post</h1>
                    </div>
                    <div class="form-group row">
                        <label for="text" class="col-md-4 col-form-label">Title</label>
                        <input id="text"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="text"
                               value="{{ old('text') ?? $user->profile->title }}" autocomplete="text" autofocus>

                        @error('text')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="ispublic" class="col-md-4 col-form-label">Publicity</label>
                        <select name="ispublic" id="ispublic">
                            <option value="Public" input value='1'>Public</option>
                            <option value="Private" input value='0'>Private</option>
                        </select>
                        @error('text')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <label for="image" class="col-md-4 col-form-label">Update Post Image</label>
                <input type="file" class="form-control-file" id="image" name="image">

                @error('image')
                <strong>{{ $message }}</strong>
                @enderror


            </div>

            <div class="row pt-4">
                <button class="btn btn-primary">Save Post</button>
            </div>

        </form>

    </div>
@endsection
