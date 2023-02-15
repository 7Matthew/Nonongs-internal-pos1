<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <base href="{{ URL::to('/') }}">
      
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

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
    {{-- Animate on Scroll --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    {{-- JQUERY --}}
    <script src="js/jquery.min.js"></script>
    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
</head>
<body class="hold-transition sidebar-mini">

{{-- ANIMATE ON SCROLL --}}
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center bg-warning">
    <img class="animation__shake img-circle" src="images/logo.jpg" alt="Nonong's Logo" height="500" width="500">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand-xs navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="ml-3 nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >

      @yield('topnav-items')
      <div class ="dropdown me-3">
        <a class = "btn dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true" data-bs-placement="bottom" title="Account"><i class="fa-solid fa-user 100 fa-lg m-2">
        </i></a>
        <ul class="dropdown-menu" style="width:20px;">
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
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin-dashboard')}}" class="brand-link">
      <img src="images/logo.jpg" alt="Nonong's Fried Chicken" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" id="shadowed-text">WELCOME</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex p-auto">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin-dashboard') }}" class="d-block text-light">{{ Auth::user()->username}} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('admin-dashboard') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dashboard">
              <i class="fa-solid fa-chart-line fa-lg mr-auto"></i>  
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('orders') }}"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Order History">
                <i class="fa-solid fa-table fa-lg mr-auto"></i> 
              <p>
                Order History
              </p>
            </a>
          </li>
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('categories.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Food Menu">
              <i class="fa-solid fa-sort fa-lg mr-auto"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('food-item.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Food Menu">
              <i class="fas fa-hamburger fa-lg mr-auto"></i>  
              <p>
                Food Menu
              </p>
            </a>
          </li>
          </li> <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('inventory.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manage Inventory">
              <i class="fa-solid fa-warehouse fa-lg"></i>
              <p>
                Inventory 
              </p>
            </a>
          </li> 
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('manage-users.index') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manage Users Account">
              <i class="fa-solid fa-user fa-lg mr-auto"></i>  
              <p>
                Users
              </p>
            </a>
          </li> 
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ url('/menu') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Point Of Sales">
              <i class="fa-solid fa-mobile-retro fa-lg mr-auto"></i>
              <p>
                POS
              </p>
            </a>
          </li> 
          <li class="nav-item hover-transform">
            <a class="nav-link" href="{{ route('reports') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Generate Reports">
              <i class="fa-solid fa-chart-simple fa-lg"></i>
              <p>
                Reports 
              </p>
            </a>
          </li> 
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <div class="container-fluid">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </div>
  
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->

{{-- <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App --> --}}

<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
