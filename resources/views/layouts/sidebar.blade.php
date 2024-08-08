<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOARS</title>
    <!-- Add the Bootstrap CSS CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/admingeneral.css')}}">
</head>
<body>
    
    <!-- Sidebar portion  -->
    <div class="container-fluid">
        <div class="row">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light custom-navbar">
                    <div class="container">
                        <a class="navbar-brand" href="#"><h2>Dashboard</h2></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
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
                    </div>
                </nav>
            </header>
            
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                    <div class="sidebar-brand">
                            <h1> SOARS</h1>
                        </div>

                        <li class="nav-item">
                            <a class="nav-link active" href="home">
                                UserName
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="home">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="home">
                                Audit Log
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="home">
                                User Privillege
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('studlist') }}">
                                Students List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courselist') }}">
                                Courses List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Organization List
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    @yield('content')
</body>
</html>