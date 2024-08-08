<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOARS') }}</title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{url('/photos/OSA LOGO.png')}}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css')}}" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/OSAgeneral.css')}}">
    <script src="{{url('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentgeneral2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />\
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
    .navbar-brand {
        display: flex;
        align-items: center;
    }
    .navbar-brand img {
        max-width: 50px;
        margin-right: 6px;
    }
    .navbar-brand h2 {
        margin: 0;
        color: white;
    }
    .navbar-brand h5 {
        margin: 0;
        color: white;
    }
    
    /* Additional CSS styles for modal */
    .modal-content {
    border-radius: 10px;
    }
    
    .modal-header {
    border-bottom: none;
    }
    
    .modal-footer {
    border-top: none;
    }
    
    .modal-body {
    padding: 20px;
    }
    
    .modal-body textarea {
    resize: none;
    }
    
    .btn-primary {
    background-color: #4267B2;
    border-color: #4267B2;
    }
    
    .btn-primary:hover {
    background-color: #3b5998;
    border-color: #3b5998;
    }
    
    .btn-secondary {
    background-color: #ced4da;
    border-color: #ced4da;
    }
    
    .btn-secondary:hover {
    background-color: #b1bbc4;
    border-color: #b1bbc4;
    }
    
    .announcement {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    width: 1100px;
    margin: auto;
    height: 180px;
    color: black;
    padding-bottom: 10px;
    
    }
    
    .announcement-header {
    border-bottom: 1px solid #ccc;
    margin-bottom: 10px;
    padding-bottom: 10px;
    }
    
    .announcement-title {
    font-size: 24px;
    margin: 0;
    color: black;
    }
    
    .announcement-date {
    color: #666;
    margin: 5px 0;
    }
    
    .announcement-link {
        color: black; /* Set the color to black */
        text-decoration: none; /* Remove underline */
    }
    
    .announcement-content {
    font-size: 12px;
    line-height: 1.6;
    color: black;
    }
    
    </style>
    
    
    <!-- Scripts -->
</head>
<body>
    <div class="container-fluid" >
        <nav id="sidebar" class="navbar bg-body-tertiary fixed-top" style="padding: 8px 8px 8px 8px; background-color: #0762c5 !important;">
                <div class="container d-flex align-items-center" style="background-color: #0762c4;">
                    <img src="/photos/OSA LOGO.png" alt="" style="max-width: 50px;">
                    
                    <h1 style="color:white;">SOARS STUDENT LEADER</h1>                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                  
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header" style="background-color: #064b96;">
                        <img src="/photos/OSA LOGO.png" alt="" style="max-width: 50px; margin-right: 6px;">
                        <h1 style="color:white;">SOARS</h1><br> 
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body" style="background-color: #0762c4">
                      <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                        <ul class="nav flex-column">

                            <li class="nav-item">
                                <a class="nav-link active" href="{{url('/osaemp/user')}}" style="color:white;">
                                    <i class="fa-regular fa-circle-user fa-lg" style="margin-right:15px; font-size: 25px;"></i>
                                    {{Auth::user()->name}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/osaemp')}}" style="color:white;">
                                    <i class="fa-regular fa-clipboard fa-lg" style="margin-right: 20px; font-size: 25px;"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/osaemp/reports')}}" style="color:white;">
                                    <i class="fa-solid fa-clipboard-list fa-lg"style="margin-right:20px; font-size: 25px;"></i>
                                    Reports
                                </a>
                            </li>
                
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/osaemp/activity_approval')}}" style="color:white;">
                                    <i class="fa-solid fa-clipboard-list fa-lg" style="margin-right:20px; font-size: 25px;"></i>
                                    Event Manager
                                </a>
                            </li>
                
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/osaemp/userlist')}}" style="color:white; padding-left: 15px;">
                                    <i class="fa-regular fa-address-book fa-lg" style="margin-right:20px; font-size: 25px;"> </i>Manage Users
                                </a>
                            </li>
                
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/osaemp/organization_list')}}" style="color:white;  padding-left: 15px; ">
                                    <div class="d-flex align-items-center" style="margin-left: -4px;">
                                        <i class="fa-solid fa-users fa-lg" style="margin-right: 18px; font-size: 25px;"></i>
                                        Manage Organization
                                    </div>
                                </a>
                            </li>
                            
                        
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" style="color:white;">
                                    <i class="fa-solid fa-right-from-bracket fa-lg" style="margin-right: 20px; font-size: 20px;"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="color:white;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                      </ul>
                      
                    </div>
                  </div>
                </div>
              </nav>
    
        </div>
    </div>


@yield('content')
