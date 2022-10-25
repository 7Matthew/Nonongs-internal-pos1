@extends('admin.layouts.admin-layout')

@section('topnav-items')
        <div class="row">
            <div class="col">
                <div class="col mt-2" data-aos="fade-in"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                    <nav class = "navbar-nav" id="categories">
                        <li class="nav-item justify-content-end">
                            <a href="{{ route('food-item.create')}}" class="btn btn-success btn-md ml-5" title="Add Menu">
                                <i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new Item
                            </a>
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
<div class="container-fluid mt-5" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#categories">
    @if(Session::has('success'))
    <div class="toast-show alert alert-success text-dark mt-4 p-auto" data-aos="fade-in" delay="500" duration="700" data-bs-dismiss="alert" aria-label="Close" role="alert">
        {{ 'Item Added Successfully!' }}
    </div>
    @endif
    @if(Session::has('edit-success'))
        <div class="alert alert-success text-dark mt-4 p-auto " data-aos="fade-in" delay="500" duration="700" data-bs-dismiss="alert" aria-label="Close" role="alert">
            {{ 'Item Edited Successfully!' }}
        </div>
    @endif
    @if(Session::has('delete-success'))
        <div class="alert alert-success text-dark mt-4 p-auto " data-aos="fade-in" delay="500" duration="700" data-bs-dismiss="alert" aria-label="Close" role="alert">
            {{ 'Item Deleted Successfully!' }}
        </div>
    @endif
    <div class="row">
        <div class="col p-5 m-relative" id="fried-chicken" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
            <div class="card border-3">
                <div class="card-header text-gray bg-danger">
                    <h6> Fried Chicken </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "fried-chicken")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto">
                                        <div class="page-content justify-content">
                                            <a href="{{ route('food-item.show',['food_item' => $item['id']])}}"><img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" id="rice-meals" data-aos="fade-right" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Rice Meals </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "rice-meals")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto">
                                        <div class="page-content justify-content">
                                            <a href="{{ route('food-item.show',['food_item' => $item['id']])}}"><img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" id="soup" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Soup </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "soup")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto">
                                        <div class="page-content justify-content">
                                            <a href="{{ route('food-item.show',['food_item' => $item['id']])}}"><img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" id="rice" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Rice </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "rice")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto">
                                        <div class="page-content justify-content">
                                            <a href="{{ route('food-item.show',['food_item' => $item['id']])}}"><img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card border-3 mt-2" id="others" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-gray bg-danger">
                    <h6> Other Specialties </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "other-specialties")
                                <div class="col-lg-2">
                                    <div class="card no-border m-relative p-auto">
                                        <div class="page-content justify-content">
                                            <a href="{{ route('food-item.show',['food_item' => $item['id']])}}"><img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                            </a>
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

@endsection
