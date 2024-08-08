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

    <!--FullCalendar-->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>


    @if (Route::is('osaorganization_new')||Route::is('osaorganization_pending_edit_view'))
    <style> form {
        text-align: left; /* Align text in the form to the left */
    }

    form label {
        display: block;
        margin-bottom: 8px;
    }

    form textarea,
    form input {
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 16px;
    }</style>
        
    @endif
    
    
    <!-- Scripts -->
</head>
<body>

<!--Hamburger Menu-->
<div class="container-fluid" >
    <div class="row">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light custom-navbar">
                <div class="container">
                    <a class="navbar-brand" >

                        @if (Route::is('osaemp'))
                            <h2>Home</h2>

                        @elseif (Route::is('osaactivity'))
                            <h2>Approved Activity</h2>

                        @elseif(Route::is('osaorgact'))
                            <h2>Organization Activation</h2>

                        @elseif (Route::is('osadashboard'))
                            <h2>Dashboard</h2>

                        @elseif (Route::is('osauser'))
                            <h2>{{Auth::user()->name}}</h2>

                        @elseif (Route::is('osauserlist'))
                            <h2>User List</h2>

                        @elseif (Route::is('osareports'))
                            <h2>Reports</h2>

                        @elseif (Route::is('osaorganizationlist'))
                            <h2>Oganization List</h2>

                        @elseif (Route::is('osaorganization_new'))
                            <h2>New Organization</h2>

                        @elseif (Route::is('osaactivityevent'))
                            <h2>Event Manager</h2>
                            
                        @elseif (Route::is('osaactivityapproval'))
                            <h2>Event manager</h2>
                        @endif


                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    @if (Route::is('osauserlist') || Route::is('osaorganizationlist'))
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <form class="form-inline">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </nav>
        </header>

        <nav id="sidebar" class="navbar bg-body-tertiary fixed-top" style="padding: 8px 8px 8px 8px; background-color: #0762c5 !important; ">
            <div class="container" style="background-color: #0762c4;">
                
                <img src="/photos/OSA LOGO.png" alt="" style="max-width: 50px;">
                <h1 style="color:white;">SOARS OSA</h1>
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
<script src="/bootstrap-5.3.2-dist/js/bootstrap.js"></script>
<script src={{url('https://code.jquery.com/jquery-3.6.0.min.js')}}></script>
<script src={{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js')}}></script>
<script src={{url('https://js.pusher.com/8.2.0/pusher.min.js')}}></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e972c3b0e0031d8238fe', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      $.ajax({
        type:'GET',
        url: '/osaemp/updateunseenmessage',
        data: {
        }
        success: function(data){
        console.log(data.unseenCounter);
        $('.pending-div').empty();
          html = ``;
          if(data.unseenCounter >0){
            html += `<span style="right:68px;" class="pending-notification-chat">`${data.unseenCounter}
          }
          $('.pending-div').html(html);
        }
      });
    });
  </script>
</body>
</html>
