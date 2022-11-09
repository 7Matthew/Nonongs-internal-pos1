@extends('staff.layouts.staff-layout')

@section('topnav-items')
        <div class="row">
            <div class="col">
                <div class="col mt-2" data-aos="fade-in"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                    <nav class = "navbar-nav" id="categories">
                        <li class="nav-item justify-content-end">
                            <a class="ml-4 fs-5" href="#fried-chicken">Fried Chicken</a>
                            <a class="ml-4 fs-5" href="#rice-meals">Rice Meals</a>
                            <a class="ml-4 fs-5" href="#soup">Soup</a>
                            <a class="ml-4 fs-5" href="#rice">Rice</a>
                            <a class="ml-4 fs-5" href="#others">Others</a>
                        </li>
                    </nav> 
                </div>
            </div>
        </div> 
@endsection

@section('title','Food Menu')
@section('content')   
<script src="js/jqueryFunctions.js"> </script>
<div class="container-fluid" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#categories">
    <div class="row">
        <div class="col p-5 m-relative">
            <div class="card">
                <div class="card-header">
                    Form
                </div>
                <div class="card-body">
                    <form action="" class="form-group" enctype="multipart/form-data">
                        Select Food <select class="form-control" name="order-item" id="order-item">
                            @foreach ($data as $item)
                                <option value={{$item->name}}>{{$item->name}}</option>  
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col p-5 text-dark m-relative">
            <div class="card border-3" id="fried-chicken" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Fried Chicken </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "fried-chicken")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end" id="{{$item->id}}">
                                        <button class="btn btn-light">
                                            <div class="page-content text-center">
                                                <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                <p class="justify-content" font size ="2px">{{$item->name}}</p>
                                                <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                                <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3" id="rice-meals" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Rice Meals</h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "rice-meals")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end" id="{{$item->id}}">
                                        <button class="btn btn-light">
                                            <div class="page-content text-center">
                                                <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                <p class="justify-content" font size ="2px">{{$item->name}}</p>
                                                <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                                <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3" id="soup" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Soup </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "soup")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end" id="{{$item->id}}">
                                        <button class="btn btn-light">
                                            <div class="page-content text-center">
                                                <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                <p class="justify-content" font size ="2px">{{$item->name}}</p>
                                                <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                                <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3" id="rice" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Rice </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "rice")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end" id="{{$item->id}}">
                                        <button class="btn btn-light">
                                            <div class="page-content text-center">
                                                <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                <p class="justify-content" font size ="2px">{{$item->name}}</p>
                                                <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                                <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3" id="others" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Other Specialties </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "other-specialties")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto justify-content-end" id="{{$item->id}}">
                                        <button class="btn btn-light">
                                            <div class="page-content text-center">
                                                <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                <p class="justify-content" font size ="2px">{{$item->name}}</p>
                                                <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                                <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                            </div>
                                        </button>
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
                <div class="card-header">Order</div>
                <div class="card-body text-dark">
                    <table class="table table-bordered">
                        <tr class="bg-warning text-center">
                            <th>Food</th>
                            <th>Qty</th>
                            <th>Stocks</th>
                            <th>Price</th>
                        </tr>
                        <form action="" class="form" enctype="multipart/form-data">
                            <tbody>
                                @foreach ($data as $item)
                                    <tr id={{'hide'.$item->id}} style="display:none;">
                                    <td>
                                        <button type="button" class="btn btn-light btn-sm p-1" title="remove" id={{'remove'.$item->id}}><i class="fa-regular fa-circle-xmark fa-lg mr-1"></i></button>{{$item->name}}
                                    </td>
                                    <td>
                                            <button type="button" class="btn btn-danger btn-sm mr-1" id={{'increment'.$item->id}}>-</button>
                                            <input type="number" name="quantity" width="10px">
                                            <button type="button" class="btn btn-success btn-sm ml-1" id={{'decrement'.$item->id}}>+</button>
                                    </td>
                                    <td>
                                            {{$item->stocks}}
                                    </td>
                                    <td>
                                            {{$item->price}}
                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </form>
                    </table>
                    <br>
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
