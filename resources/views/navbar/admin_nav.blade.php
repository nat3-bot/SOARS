<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOARS') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{url('/photos/OSA LOGO.png')}}">
    <link href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admingeneral.css')}}">
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css')}}" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{url('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js')}}"></script>
    

    <!-- Scripts -->
    
</head>
<body>
    <!--Sidebar portion-->
    <div class="container-fluid">
        <div class="row">
            <header>
                    <div class="container">
                        <a class="navbar-brand">
                        @if (Route::is('admin'))
                            <h2 >Dashboard</h2>
                        @elseif (Route::is('studlist'))
                            <h2 >Manage Students</h2>
                        @elseif (Route::is('auditlog'))
                            <h2 style="margin-left: 150px;">Audit Log</h2>
                        @elseif (Route::is('admin_profile'))
                            <h2 style="margin-left: 150px;">Admin Profile</h2>
                        @elseif (Route::is('osalist'))
                            <h2 >OSA Employee List</h2>
                        @elseif (Route::is('rso_list'))
                            <h2 >Student Organization List</h2>
                        @endif
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
            </header>
            <nav id="sidebar" class="navbar bg-body-tertiary fixed-top"  style="padding: 8px 8px 8px 8px; background-color: #0762c5 !important; ">
                <div class="container" style="background-color: #0762c4;">
                    <!--Toggler-->
                    <img src="{{url('/photos/OSA LOGO.png')}}" alt="Logo" style="width: 40px; height: 40px;">
                                <h3 style="color: white;">SOARS ADMIN</h3>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <div class="d-flex align-items-center">
                            <span class="navbar-toggler-icon"></span>
                        </div>
                    </button>
                        <!--Content-->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color:#064b96;">
                        <div class="offcanvas-header d-flex justify-content-between align-items-center">
                            <div class="sidebar-brand">
                                <div class="d-flex align-items-center">
                                <img src="{{url('/photos/OSA LOGO.png')}}" alt="Logo" style="width: 40px; height: 40px;">
                                    <h1 style="color:white;">SOARS</h1> 
                                </div> 
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" style="color:white;"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin_profile')}}">
                                        <div class="d-flex align-items-center" style="margin-left: -10px; color:white;">
                                            <i class="fa-regular fa-circle-user fa-lg" style="margin-right:20px; font-size: 25px;"></i>
                                            <span class="ml-2">{{Auth::user()->name}}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin') }}" >
                                        <div class="d-flex align-items-center" style="margin-left: -10px; color:white;">
                                            <i class="fa-regular fa-clipboard fa-lg" style="margin-right:20px; font-size: 25px;"></i>
                                            <span class="ml-2">Dashboard</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('auditlog')}}">
                                        <div class="d-flex align-items-center" style="margin-left: -10px; color:white;">
                                            <i class="fa-regular fa-paste fa-lg" style="margin-right:20px; font-size: 25px;"></i>
                                            <span class="ml-2">Audit log</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('studlist')}}">
                                        <div class="d-flex align-items-center" style="margin-left: -10px; color:white;">
                                            <i class="fa-regular fa-address-book fa-lg" style="margin-right:20px; font-size: 25px;"></i>
                                            <span class="ml-2">Manage Students</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('osalist')}}">
                                        <div class="d-flex align-items-center" style="margin-left: -10px; color:white;">
                                            <i class="fa-regular fa-address-book fa-lg" style="margin-right:20px; font-size: 25px;"></i>
                                            <span class="ml-2">Manage OSA Employees</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/rso_list">
                                        <div class="d-flex align-items-center" style="margin-left: -10px; color:white;">
                                            <i class="fa-solid fa-users fa-lg" style="margin-right:19px; font-size: 25px;"></i>
                                            <span class="ml-2">Organization List</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" 
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();" style="color:white;">
                                        <div class="d-flex align-items-center" style="margin-left: -9px;">
                                            <i class="fa-solid fa-right-from-bracket fa-lg" style="margin-right:21px; font-size: 25px;"></i>
                                            <span class="ml-2">{{ __('Logout')}}</span>
                                        </div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
                <!--End of content-->
         
@yield('content')

            
@stack('scripts')

</body>
</html>