@extends('staff.layouts.staff-layout')

@php
    $categories = \App\Models\Category::where('label', '!=', 'ingredients')->get();;
@endphp                               


@section('title','Food Menu')
@section('content')   
<script src="js/jqueryFunctions.js"></script>

<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed bottom-0 end-0 p-3"> 
        @foreach ($data as $item)
            <div class="toast align-items-center text-bg-success border-0" id={{"addToCart".$item->id}} role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-bell fa-lg"></i> {{$item->name}} added to cart!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="toast align-items-center text-bg-danger border-0" id={{"removeToCart".$item->id}} role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-bell fa-lg"></i> {{$item->name}} Removed to cart!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="toast align-items-center text-bg-success border-0" id={{"toast_record_summary".$item->id}} role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-bell fa-lg"></i> {{$item->name}} Added to order Summary!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container-fluid">
    <div class="row my-4">
        <div class="col m-relative">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <p>Nonong's Fried Chicken Menu</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 nav justify-content-end">
                            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </button>
                            <nav class="navbar-nav" id="category">
                                <ul class="dropdown-menu">
                                    <li>
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item" href="{{"#".$category->name . $category->id}}">{{$category->name}}</a>
                                        @endforeach
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 overflow-auto" style="position:static; height:300px;" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#category" tabindex="0">
                    <div class="row">
                        @foreach ($categories as $category)
                            <section class="mt-4" >
                                <h5  id={{$category->name.$category->id}}>{{$category->name}}</h5>
                            </section>
                            @foreach ($data as $item)
                                @if($item->category_id == $category->id)
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                                        <div class="card no-border m-relative justify-content-end" id="{{$item->id}}">
                                            <button class="btn btn-light" tooltip="{{$item->name . ' ' . $item->description}}">
                                                <div class="page-content text-center">
                                                    <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                    <section class="overflow-hidden" style="height:50px;">
                                                        <p class="text-center" font size ="2px">{{$item->name . ' '. $item->description}}</p>
                                                    </section>
                                                    <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
                                                    <p class="bg-danger justify-content-center d-flex" font size ="2px">Stock: {{$item->stocks}}</p>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-dark m-relative">
            <div class="card" id="cart" data-aos="fade-left"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-muted">Cart Items</div>
                <div class="card-body text-dark overflow-auto" style="position:static; height:300px;">
                    {{-- FORM --}}
                    <form action="{{ route('make_order.store') }}" method="post" class="form" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                            <thead class="bg-warning">
                                <th class="text-center">Food</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                                {{-- CART CONTENT --}}
                                @foreach ($data as $item)
                                    <tr id={{'hide'.$item->id}}>
                                    <td>
                                        <button type="button" class="btn btn-light btn-sm p-1" title="Add to Order Summary" id={{"record_to_summary".$item->id}}><i class="fa-solid fa-circle-plus text-success"></i></button>
                                        <button type="button" class="btn btn-light btn-sm p-1" title="Remove to cart" id={{'remove'.$item->id}}><i class="text-danger fa-solid fa-trash-can fa-lg "></i></button><b id={{"item_name".$item->id}}>{{$item->name}}</b>
                                    </td>
                                    <td>
                                            <button type="button" class="btn btn-danger btn-sm mr-1" id={{"decrement".$item->id}}>-</button>
                                            <input type="number" min=0 max="200" name="quantity" id={{"input_quantity".$item->id}} width="5px" value="0" class="col-lg-2 col-md-4 col-sm-6 text-center" readonly>
                                            <button type="button" class="btn btn-success btn-sm ml-1" id={{"increment".$item->id}}>+</button>
                                    </td>
                                    <td>
                                            <p id={{"cart_item_price".$item->id}}>{{$item->price}}</p>
                                    </td>
                                    </tr>
                                @endforeach
                                    <tr class="text-end table-secondary">
                                        <td></td>
                                        <td></td>
                                        <td colspan="3">
                                            <div class="row md-2">
                                                
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        <div class="row content-end">

                        </div>
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <label for="total_price" class="form-text">Total price: </label>
                            </div>
                            <div class="col-lg-8 text-left">
                               <input type="number" name="total_price" placeholder="&#8369" id={{"total"}} width="5px" class="form-control col-lg-4 col-md-4 col-sm-6 text-center bg-warning" readonly>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-4">
                                <label for="payment" class="form-text">Payment: </label>
                            </div>
                            <div class="col-lg-8 text-left">
                               <input type="number" name="payment" id="payment" width="5px" class="form-control col-lg-4 col-md-4 col-sm-6 text-center bg-success">
                                    @error('payment')
                                        <div class="alert alert-danger" role="alert">
                                        <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        
                        <div class="offset-sm-5">
                            {{-- Purposefully empty --}}
                        </div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal" id="submit_order" data-bs-target="#submitOrder">
                            Submit 
                        </button>
                          <!-- Modal -->    
                        <div class="modal fade" id="submitOrder" tabindex="-1" aria-labelledby="modal-confirm-order" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                <div class="modal-header bg-alert">
                                  <h1 class="modal-title fs-4" id="modal-confirm-order">Confirm Order?</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Order Summary</p> 
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" readonly></textarea>
                                    <div class="row my-3">
                                        <div class="col-lg-4">
                                            <label for="modeOfPayment" class="form-label">Payment Method</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select name="modeOfPayment" id="modeOfPayment" class="form-select">
                                                <option value="Cash">Cash</option>
                                                <option value="GCash">GCash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <p id="summary_total"></p>
                                    <p id="summary_change"></p>
                                    <small class="text-muted">{{ strToUpper(date("F j Y h:i:s")) }}</small>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-success">Confirm</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col p-5 text-dark m-relative" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#page-content">
            @foreach ($categories as $category)
            <div class="card border-3 mt-2" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out" >
                <div class="card-header text-gray bg-danger">
                    <h6 id={{$category->name}}> {{$category->name}} </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category_id == $category->id)
                                <div class="col-lg-2 col-md-4 col-sm-6 w-25">
                                    <div class="card no-border m-relative p-auto justify-content-end" id="{{$item->id}}">
                                        <button class="btn btn-light">
                                            <div class="page-content text-center">
                                                <img class = ""src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                                <p class="overflow-hidden justify-content" font size ="2px">{{$item->name . ' '. $item->description}}</p>
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
            @endforeach
        </div>
    </div> --}}
</div>



@endsection
