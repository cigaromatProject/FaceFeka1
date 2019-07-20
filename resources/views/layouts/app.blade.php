
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--My Style * CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mystyle.css') }}" />

    <!-- Bootstrap release 4.3.1 * CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/4.3.1/css/bootstrap.min.css') }}" />

    <!-- Fontawesome release 5.8.1 * CSS -->
    <link rel="stylesheet" href="{{ asset('fontawesome/5.8.1/css/all.css') }}" />
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            @if(Auth::user())
                <a href="http://localhost:8000/profile/ {{ Auth::user()->id }} ">
                    <div><img src="{{ URL::to('/') }}/svg/images/logo1_converted.svg" style="height: 25px" class="pr-3"></div>
                </a>
            @endif
            <a class="navbar-brand d-flex" href="{{ url('/') }}">
                <div class="pl-2 pb-0">FaceFEKA</div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <div class="wrap">
                <div class="search">
                    <form method="get" action="{{url('search')}}">
                    <input type="text" id='search' name="q" autocomplete="off" class="searchTerm" placeholder="Search for people...">
                    <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                    <div class="search_results" style="display: none;">
                        <ul id="ajax_result">


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

    <script src="{{asset('js/app.js')}}"></script>

    <script>
    $(document).ready(function() {
        var timer = null;
        $("#search").on("keyup",function(){
            clearTimeout(timer);
            if($(this).val() == ''){
                $('.search_results').hide();
            }else{
                timer = setTimeout(getSearch, 250)
            }
        });

        function getSearch() {
            var url = "{{url('/')}}";
            var value = $('#search').val();
            $.ajax({
                type: 'get',
                url: url+'/getSearch/'+value,
                async: false,

                success: function (data) {
                    if(data){
                        $('.search_results').show();
                        $('.search_results ul').html(data);
                    }else{
                        $('.search_results').hide();

                    }
                }
            })
        }
    })
</script>

</body>
</html>

