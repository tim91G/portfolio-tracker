<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portfolio Tracker') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('/favicon/apple-touch-icon.png') }}"/>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('/favicon/favicon-32x32.png') }}"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('/favicon/favicon-16x16.png') }}"/>
    <link rel="manifest" href="{{ URL::asset('/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ URL::asset('/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    @stack('css')

</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('favicon/android-chrome-384x384.png') }}" height="40px" width="40px">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link" role="button" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" role="button"
                               href="{{ route('watchlist') }}">{{ __('Watchlist') }}</a>
                        </li>

                    @else
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Portfolio Tracker') }}
                        </a>
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <form id="import-data" action="{{ route('import') }}" method="POST"
                                  enctype="multipart/form-data">
                                <label class="btn btn-dark mr-3">
                                    Import <input type="file" name="file" class="form-control"
                                                  onchange="this.form.submit()" hidden>
                                </label>
                                @csrf
                            </form>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="pb-5">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>

</html>
