<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth_style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/authSmStyle.css') }}" media="screen and (min-width:768px)">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-style navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'TimE is AMOr') }}
                </a>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn auth-btn" type="button" href="{{ route('login') }}">{{ __('message.Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                    <a class="btn nav-btn-style" type="button" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                    </ul>
            </div>
        </nav>
        <main class="main-content-style">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/planList_ajax.js') }}" type=module></script>
    <script src="{{ asset('js/calendar.js') }}" type=module></script>
</body>
</html>
