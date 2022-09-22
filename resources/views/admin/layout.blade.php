<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="{{ url('css/bootstrap.min.css') }}">
    <!-- JavaScript -->
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100;0,8..144,200;0,8..144,300;0,8..144,400;0,8..144,500;0,8..144,600;0,8..144,700;0,8..144,800;0,8..144,900;1,8..144,100;1,8..144,200;1,8..144,300;1,8..144,400;1,8..144,500;1,8..144,600;1,8..144,700;1,8..144,800;1,8..144,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jpg">
    <link href="/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="/fontawesome/css/brands.css" rel="stylesheet">
    <link href="/fontawesome/css/solid.css" rel="stylesheet">
</head>
<body>
    <div class ="container-fluid mb-5">
        <nav class="navbar fixed-top bg-warning position-absolute">
            <a class = "nav-link text-light" href="#"> <i class="fa-solid fa-bars text-light fa-lg m-3" ></i></a>
                
                    <div class ="dropdown me-3">
                        <a class = "btn dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true"data-bs-placement="bottom" title="Account"><i class="fa-solid fa-user 100 fa-lg m-2">
                        </i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Log-out') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                        </form>
                            </li>
                        </ul>
                    </div>
                </ul>           
        </nav>
    </div>
    <div class="sidebar">
        <ul class="nav justify-content-beginning">
            <li><a class = "btn nav-link text-light mt-2" href="{{ route('admin-dashboard') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dashboard"><i class="fa-solid fa-chart-line fa-2x m-2"></i>{{' Dashboard'}}</a></li>
            <li><a class = "btn nav-link text-light mt-2" href="{{ route('order_history') }}"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Order History"><i class="fa-solid fa-table fa-2x mr-2"></i>{{'Order History'}}</a></li>
            <li><a class = "btn nav-link text-light mt-2" href="{{ route('foodMenu') }}"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Food Menu"><i class="fas fa-hamburger fa-2x m-2"></i>{{' Food Menu'}}</a></li>
            <li><a class = "btn nav-link text-light mt-2" href="{{ route('forecasting') }}"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Sales Forecast and CRM"><i class="fas fa-tachometer-alt fa-2x m-2"></i>{{' Sales Forecast'}}</a></li>
        </ul>
        </div>
    <div class ="page-content">
        @yield('content')
    </div>
    
</body>
</html>
