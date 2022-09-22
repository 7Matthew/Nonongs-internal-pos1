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
        <div class="row bg-dark text-light p-3">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-md">
                    <ul class ="nav-bar nav justify-content mx-auto">
                        <li class="nav-item me-2"> <a class="" href="{{ url('guitars/create') }}">Create</a></li>
                        <li class="nav-item me-2"> <a class="" href="{{ url('guitars') }}">Home</a></li>
                        <li class="nav-item me-2"> <a href="{{ url('/') }}"> Welcome</a> </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class ="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray 900 sm:items-center py-4 sm:pt-0">
            @yield('content')
        </div>
    </div>
    
    
</body>
</html>
