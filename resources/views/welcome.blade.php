<!DOCTYPE html>
<html lang="en" dir="ltr">
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
  	<!-- Google Fonts -->
  	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100;0,8..144,200;0,8..144,300;0,8..144,400;0,8..144,500;0,8..144,600;0,8..144,700;0,8..144,800;0,8..144,900;1,8..144,100;1,8..144,200;1,8..144,300;1,8..144,400;1,8..144,500;1,8..144,600;1,8..144,700;1,8..144,800;1,8..144,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jpg">
  </head>
  <body>
    <section>
        <div class="imgBx">
            <img src= "images/chicken.jpg">
        </div>
        <div class="contentBx">
            <div class = "cont">
                <h1>Welcome to Nonong's Fried Chicken</h1>
                <center><h4>Choose your role</h4></center>
                    <!--<div class="contBtn">-->
                        @if (Route::has('admin-login'))
                             <a href="{{ route('admin-login') }}" style="text-decoration: none"><button class="btn-1">ADMIN</button></a>
                        @endif
                        @if (Route::has('staff-login'))
                        <a href="{{ route('staff-login') }}" style="text-decoration: none"><button class="btn-2">STAFF</button></a>
                        @endif
                    <!--</div>-->
            </div>
        </div>
    </section>
    </div>
  </body>
</html>
