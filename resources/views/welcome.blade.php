<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"><meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Welcome to Nonong's Fried Chicken</title>
  	<!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
  	<!-- CSS -->
  	<link rel="stylesheet" type="text/css" href="css/landing.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  	<!-- Google Fonts -->
  	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100;0,8..144,200;0,8..144,300;0,8..144,400;0,8..144,500;0,8..144,600;0,8..144,700;0,8..144,800;0,8..144,900;1,8..144,100;1,8..144,200;1,8..144,300;1,8..144,400;1,8..144,500;1,8..144,600;1,8..144,700;1,8..144,800;1,8..144,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jpg">
  </head>
  <body>
    <nav>
      <ul class="nav bg-warning sticky-top">
        <a class = "navbar-brand" href="{{ url('/') }}"> <img class="m-2" src="images/logo.jpg" alt="logo" width ="30px" height ="30px"></a>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="row mt-5">
        <div class="col-lg-5">
          <div class="imgBx img">
            <img src= "images/chicken.jpg">
          </div>
        </div>
        <div class="col-lg-7  ">
          <div class="row text-center">
            <h2 id="header">
              Welcome to Nonong's
              <p>Fried Chicken</p>
              <h5>Choose your role</h5>
            </h2>
          </div>
          <section class="row text-center">
            <h1>
              <a href="{{ route('admin-login') }}" class="btn-1 btn btn-danger btn-lg w-50 my-2"> <p class="mt-4">ADMIN</p></a>
              <a href="{{ route('staff-login') }}" class="btn-2 btn btn-danger btn-lg w-50 my-2"><p class="mt-4">STAFF</p></a>
            </h1>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>


