<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HelpMe!') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
    <section id="header">
        <div id="app">
            <nav class="navbar navbar-expand-lg fixed-top" >
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <i class="fas fa-bars" ></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-top:20px">
                        <ul class="navbar-nav mx-auto" >
                            <li class="nav-item">
                                <a class="nav-link" href="/homepage"style="color: #ff8303;margin:0 20px;font-size:25px">Home</a>
                            </li>
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}"style="color: #ff8303;margin:0 20px;font-size:25px">{{ __('Login') }} </a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                    <button class="myButton">
                                        <a class="nav-link" href="{{ route('register') }}"style="color: ff8303;margin:0 20px;font-size:25px">{{ __('Register') }}</a>
                                        </button>
                                    </li>
                                @endif
                            @else
                                

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            <li class="nav-item">
                                <a class="nav-link" href="#"style="color: #ff8303;margin:0 20px;font-size:25px">About us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>
    <div class="jumbotron text-center" style="background-image:url({{url('/images/hp2.jpg')}});background-size: cover;background-repeat: no-repeat;height: 80vh;color: #f0ebcc;border-radius: 0px !important;">
        <div class="intro">
            <img src="{{url('/images/logo2.png')}}" alt="logo" style="width:25%; height:25%"/>
            <h1>Get Paid Now!</h1>
        </div>
    </div>

      @yield('content')
</body>
</html>
