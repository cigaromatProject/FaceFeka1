@extends('layouts.app')

@section('content')
    <div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 off-2">
                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <div class="form-group row">
                    <label for="Post" class="col-md-4 col-form-label">Post Body</label>
                        <input id="text"
                               type="text"
                               class="form-control @error('text') is-invalid @enderror"
                               name="text"
                               value="{{ old('text') }}" autocomplete="text" autofocus>

                        @error('text')
                        <strong>{{ $message }}</strong>
                        @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <label for="image" class="col-md-4 col-form-label">Post Image</label>
            <input type="file" class="form-control-file" id="image" name="image">

            @error('image')
            <strong>{{ $message }}</strong>
            @enderror


        </div>

        <div class="row">
            <label for="image" class="col-md-4 col-form-label">Post 2nd Image</label>
            <input type="file" class="form-control-file" id="image2" name="image2">

            @error('image2')
            <strong>{{ $message }}</strong>
            @enderror


        </div>

        <div class="row pt-4">
            <select name="ispublic" id="ispublic">
                <option value="Public" input value='1'>Public</option>
                <option value="Private" input value='0'>Private</option>
            </select>
        </div>

        <div class="row pt-4">
            <button class="btn btn-primary">Post</button>
        </div>

    </form>
    </div>
@endsection
