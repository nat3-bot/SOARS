<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include any additional meta tags, stylesheets, or scripts -->
    <link rel="icon" href="{{asset('/photos/OSA LOGO.png')}}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/adminlogin.css')}}">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @stack('styles')
    @stack('jquery')
    @vite(['resources/sass/app.scss'])
</head>
<body>
    <header>
        <!-- Navbar or header content -->
        <nav>
            <ul>
                
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
        <!-- This is where the content of child views will be injected -->
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</p>
    </footer>

    <!-- Include any additional scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
