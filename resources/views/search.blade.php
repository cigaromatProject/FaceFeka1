@extends('layouts.app')
@section('content')

    <div class="container">
        <h4>Results for: {{ $query }}</h4>
        <hr />
        <ul id="searchul">
            @foreach($users as $user)

                @if($user->profile->profileImage())
                        <li><a href="{{ url('profile', $user->id) }}"><div class="media"><img class="mr-3" src="{{ asset($user->profile->profileImage()) }}" width="50" height="50"><div class="media-body"><h6 class="mt-0"> {{ $user->name }} </h6></div></div></a></li>

                @else
                    @if($user->profile->title)
                        <li><a href="{{ url('profile', $user->id) }}"><div class="media"><img class="mr-3" src="{{ asset('images/userdummy.jpg') }}" width="50" height="50"><div class="media-body"><h6 class="mt-0"> {{ $user->name }} </h6> </div></div></a></li>

                    @else
                        <li><a href="{{ url('profile', $user->id) }}"><div class="media"><img class="mr-3" src="{{ asset('images/userdummy.jpg') }}" width="50" height="50"><div class="media-body"><h6 class="mt-0"> {{ $user->name }} </h6></div></div></a></li>
                    @endif
                @endif

            @endforeach
        </ul>
    </div>

@endsection