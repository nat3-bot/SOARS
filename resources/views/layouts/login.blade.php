<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOARS') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{asset('/photos/OSA LOGO.png')}}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/adminlogin.css')}}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @stack('styles')
    @stack('jquery')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss'])
</head>
<body>
<div class="contents">
    <main class="py-4">
        @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>