<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
</head>
<body>
    <a href="{{ route('main') }}">Главная</a>
    <a href="{{ route('posts.index') }}">Посты</a>
    @if (!Auth::check())
        <a href="{{ route('login') }}">Вход</a>
        <a href="{{ route('register') }}">Регистрация</a>
    @else
        <a href="{{ route('login.logout') }}">Выйти</a>
    @endif
    <br><br>
    @yield('content')
</body>
</html>
