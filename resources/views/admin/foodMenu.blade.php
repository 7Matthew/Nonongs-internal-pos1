@extends('admin.layouts.admin-layout')

@section('title','Food Menu')
@section('content')

<body>
    <div class="foodtext">
    <h2>FOOD MENU</h2>
    <br>
    <h3>Menu List</h3>
    </div>
<div class="container-fluid">
    @if(Session::has('success'))
    <div class="alert alert-success text-dark mt-4 p-auto " role="alert">
        {{ 'Item Added Successfully!' }}
    </div>
    @endif
    @if(Session::has('edit-success'))
        <div class="alert alert-success text-dark mt-4 p-auto " role="alert">
            {{ 'Item Edited Successfully!' }}
        </div>
    @endif
    @if(Session::has('delete-success'))
        <div class="alert alert-success text-dark mt-4 p-auto " role="alert">
            {{ 'Item Deleted Successfully!' }}
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="col-lg- mt-2">
                <a href="{{ route('food-item.create')}}" class="btn btn-success btn-md ml-5" title="Add Menu">
                    <i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new Item
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col p-5 m-relative">
            <div class="card border-3">
                <div class="card-header text-gray bg-danger">
                    <h6> Combo Meals </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "combo-meal")
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
            <div class="card border-3 mt-2">
                <div class="card-header text-gray bg-danger">
                    <h6> Chicken </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "chicken")
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
            <div class="card border-3 mt-2">
                <div class="card-header text-gray bg-danger">
                    <h6> Ulam </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "ulam")
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
            <div class="card border-3 mt-2">
                <div class="card-header text-gray bg-danger">
                    <h6> Pork </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "pork")
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
            <div class="card border-3 mt-2">
                <div class="card-header text-gray bg-danger">
                    <h6> Drinks </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "drinks")
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
            <div class="card border-3 mt-2">
                <div class="card-header text-gray bg-danger">
                    <h6> Desserts </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category == "desserts")
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
            <div id="food-menu-carousel" class="carousel slide" data-bs-ride="true">
                <div class="carousel-inner">
                    <div class="carousel-item active" id="">
                        <div class="card border-3">
                            <div class="card-header text-gray bg-danger">
                                <h6> Combo Meals </h6>
                            </div>
                            <div class="card-body text-dark">
                                <div class="row">
                                    @foreach ($data as $item)
                                        @if($item->category == "combo-meal")
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
                    <div class="carousel-item" id="2">
                        <div class="card border-3 mt-2">
                            <div class="card-header text-gray bg-danger">
                                <h6> Chicken </h6>
                            </div>
                            <div class="card-body text-dark">
                                <div class="row">
                                    @foreach ($data as $item)
                                        @if($item->category == "chicken")
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
                    <div class="carousel-item" id="3">
                        <div class="card border-3 mt-2">
                            <div class="card-header text-gray bg-danger">
                                <h6> Ulam </h6>
                            </div>
                            <div class="card-body text-dark">
                                <div class="row">
                                    @foreach ($data as $item)
                                        @if($item->category == "ulam")
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
                <button class="carousel-control-prev" type="button" data-bs-target="#food-menu-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#food-menu-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
            </div>
        </div>
    </div>
</div>

@endsection
