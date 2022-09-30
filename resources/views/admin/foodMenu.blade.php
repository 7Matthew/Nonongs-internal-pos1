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
        <div class="col p-5 m-relative">
            <div class="card border-3">
                <div class="card-header text-gray bg-danger">
                    <h6> Current Items on the Menu </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        <div class="col-lg-2 mt-2">
                            <a href="{{ route('food-item.create')}}" class="btn btn-success btn-lg" title="Add Menu">
                                <i class="fa-solid fa-square-plus fa-2x mr-3"></i><h6>Add New Item</h6>
                            </a>
                        </div>
                        @foreach ($data as $item)
                            <div class="col-lg-2">
                                <div class="card no-border m-relative p-auto">
                                    <div class="page-content justify-content">
                                        <a href="{{ route('food-item.show',['food_item' => $item['id']])}}"><img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                        <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
