<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Nonong's Fried Chicken</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
    <!-- JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100;0,8..144,200;0,8..144,300;0,8..144,400;0,8..144,500;0,8..144,600;0,8..144,700;0,8..144,800;0,8..144,900;1,8..144,100;1,8..144,200;1,8..144,300;1,8..144,400;1,8..144,500;1,8..144,600;1,8..144,700;1,8..144,800;1,8..144,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo.jpg">
  </head>
  <body>
  	<div class = "container-fluid">
        <ul class="nav justify-content-end bg-warning fixed-top">
          <a class = "navbar-brand" href="{{ url('/') }}"> <img class="m-2"src="images/logo.jpg" alt="logo" width ="30px" height ="30px"></a>
            @auth
                <a href="{{ url('/admin-dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                <div class ="dropdown me-3">
                    <a class = "btn dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="true"data-bs-placement="bottom" title="Account"><i class="fa-solid fa-user 100 fa-lg m-2">
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
                @php
                    return redirect()->route('admin-dashboard');
                @endphp
            @else
                <a class ="text-sm text-gray-700 dark:text-gray-500 underline" href="{{ route('admin-login') }}">Log-in</a>
            @endif
        </ul>
  		<div class = "col-md-13 text-center " id = "header">
  			<h1><font color = "red"><b>Nonong's</b></font></h1>
  			<h2><font color = "#CFC03C"><b>Fried Chicken</b></font></h2>
  		</div>
  	</div>
  	<div class="container-fluid">
  		<div class = "row text-center">
  			<div class ="col">
  				<h5> </h5>
  			</div>
  			<div class ="col-lg-4 text-left mt-5">
  				<div class = "card" id="login-card">
  					<div class="row m-3">
  						<h5> <font color = "#808080">Please Login </font></h5>
  					</div>
  					<div class="row m-3">
  						<div class="col-lg-10 m-4">
  							<div class = "row">
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="row mb-3">
                          <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email or Username') }}</label>

                          <div class="col-md-6">
                              <input id="username" type="username" class="form-control @error('username') is-invalid @enderror @error('email') is-invalid @enderror" name="username"  value="{{ old('uusername') }}" required autocomplete="username" autofocus>

                              @error('username')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ 'Invalid Username or Password!' }}</strong>
                                  </span>
                              @enderror
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ 'Invalid Username or Password!' }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="row mb-3">
                          <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-md-6 offset-md-4">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                  <label class="form-check-label" for="remember">
                                      {{ __('Remember Me') }}
                                  </label>
                              </div>
                          </div>
                      </div>
                        <!-- Login button -->
                      <div class="row mb-0">
                          <div class="col-md-5 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Login') }}
                              </button>
                        <!-- Forgot Password -->
                              @if (Route::has('password.request'))
                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                      <font size ='1'>{{ __('Forgot Your Password?') }}</font>
                                  </a>
                              @endif
                          </div>
                      </div>
                  </form>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class ="col text-center">
  				<h5> </h5>
  			</div>
  		</div>
  	</div>
  </body>
</html>
