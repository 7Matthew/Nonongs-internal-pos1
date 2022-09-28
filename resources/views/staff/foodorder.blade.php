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
        <div class="card">
                <div class="card-body text-dark">
                    <section class="items">
                        <div class="item">
                            <img src="images/combo1.JPG">
                            <h4>COMBO 1</h4>
                            <h5>145.00 </h5>
                            <button>Add to Order</button>
                        </div>
                        <div class="item">
                            <img src="images/combo2.avif">
                            <h4>COMBO 2</h4>
                            <h5>169.00 </h5>
                            <button>Add to Order</button>
                        </div>
                        <div class="item">
                            <img src="images/combo3.avif">
                            <h4>COMBO 3</h4>
                            <h5>189.00 </h5>
                            <button>Add to Order</button>
                        </div>
                        <div class="item">
                            <img src="images/solomeal.avif">
                            <h4>Solo Meal</h4>
                            <h5>95.00 </h5>
                            <button>Add to Order</button>
                        </div>
                        <div class="item">
                            <img src="images/garlicchicken.avif">
                            <h4>Garlic Chicken Meal</h4>
                            <h5>115.00 </h5>
                            <button>Add to Order</button>
                        </div>
                        <div class="item">
                            <img src="images/lechonkawali.jpg">
                            <h4>Lechon Kawali Meal</h4>
                            <h5>130.00 </h5>
                            <button>Add to Order</button>
                        </div>
                    </section>
                    
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
