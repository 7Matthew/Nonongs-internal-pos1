@extends('staff.layouts.staff-layout')

@section('title','Food Menu')
@section('content')


<body>
    <div class="foodtext">
    <h2>FOOD MENU</h2>
        <div class="row">
            <div class="col">
                <div class="col mt-2" data-aos="fade-in"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                    <nav class = "navbar-nav" id="categories">
                        <li class="nav-item justify-content-end">
                            <a class="ml-4 fs-5" href="#combo-meals">COMBO MEALS</a>
                            <a class="ml-4 fs-5" href="#chicken">CHICKEN</a>
                            <a class="ml-4 fs-5" href="#ulam">OTHER SPECIALTIES</a>
                        </li>
                    </nav> 
                </div>
            </div>
        </div> 
    </div>
<div class="container-fluid" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#categories">
    <div class="row">
        <div class="col p-5 text-dark m-relative">
            <div class="card border-3" id="combo-meals" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Combo Meals </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "combo-meal")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end">
                                        <div class="page-content text-center">
                                            <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class="justify-content d-flex" font size ="2px">{{$item->name}}</p>
                                            <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                            <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" id="chicken" data-aos="fade-right"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Chicken </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "chicken")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end">
                                        <div class="page-content text-center">
                                            <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class="justify-content d-flex" font size ="2px">{{$item->name}}</p>
                                            <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                            <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3" id="ulam" data-aos="fade-left"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Combo Meals </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "combo-meal")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end">
                                        <div class="page-content text-center">
                                            <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class="justify-content d-flex" font size ="2px">{{$item->name}}</p>
                                            <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                            <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Chicken </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "chicken")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end">
                                        <div class="page-content text-center">
                                            <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class="justify-content d-flex" font size ="2px">{{$item->name}}</p>
                                            <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                            <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3" data-aos="fade-left"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Combo Meals </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "combo-meal")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end">
                                        <div class="page-content text-center">
                                            <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class="justify-content d-flex" font size ="2px">{{$item->name}}</p>
                                            <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                            <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" data-aos="fade-right"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Chicken </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "chicken")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end">
                                        <div class="page-content text-center">
                                            <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class="justify-content d-flex" font size ="2px">{{$item->name}}</p>
                                            <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                            <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col p-5 text-dark m-relative">
            <div class="card" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-body text-dark">
                    <h4>ORDER</h4>
                    <br>
                    <h6>2x COMBO 1--------------------------------338</h6>
                    <h6>1x SOLO MEAL-----------------------------95</h6>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Submit 
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="modal-confirm-order" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-alert">
          <h1 class="modal-title fs-4" id="modal-confirm-order">Confirm Order?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>
@endsection
