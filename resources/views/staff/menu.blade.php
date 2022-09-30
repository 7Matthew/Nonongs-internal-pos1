@extends('staff.layouts.staff-layout')

@section('title','Food Menu')
@section('content')


<body>
    <div class="foodtext">
    <h2>FOOD MENU</h2>
    <br>
    <h3>Manage your recent orders and invoices</h3>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-13 p-3 text-dark m-relative">
            <div class="card border-3">
                <div class="card-header">
                    <div class="card-body text-dark">
                        <div class="row">
                            @foreach ($food as $item)
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
                            @endforeach   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-13 p-3 text-dark m-relative">
            <div class="card">
                <div class="card-body text-dark">
                    <h4>ORDER</h4>
                    <br>
                    <h6>2x COMBO 1--------------------------------338</h6>
                    <h6>1x SOLO MEAL-----------------------------95</h6>
                        <div class="btn">
                            <button>Confirm and Print Receipt</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
