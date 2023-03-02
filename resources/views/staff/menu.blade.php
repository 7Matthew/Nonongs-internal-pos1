@extends('staff.layouts.staff-layout')

@php
    $categories = \App\Models\Category::where('label', '!=', 'ingredients')->get();;
@endphp                               


@section('title','Menu')
@section('content')   
<script type="text/javascript">
    var totalPrice = 0; 
    var cart_item_price = []; // from database
    var order_price_container = []; // a container for the price of a clicked/selected item
    const date = new Date();
    var order_description = [];

    // Required for DataTables Plugin 
    $(document).ready(function(){
        
        
        for (let counter = 0; counter < 100; counter++) {
            
            
            cart_item_price.push($("#cart_item_price"+counter).text()); // inserting values to cart_item_price variable using the value from the html text $item->price
            let hide_elements = $("#hide"+counter).hide();//initially hide all the table data
            function inputFood() {
                var total_item_price = 0;
                let input_quantity = 0;
                $.ajax({
                type: "GET",
                url: "/fetchFoodItem",
                dataType: "json",
                success: function(response) {
                    $.each(response.food, function(key, item) {
                        if ($("#" + counter).val() == item.id) {
                            // Check if the form has already been appended for this item
                            if ($("#foodItemForm" + item.id).length == 0){
                                // Create a unique ID for the form
                                var formId = "foodItemForm" + item.id;
                                // Append the form
                                $("tbody#cartContent").append('<tr id="' + formId + '">\
                                    <td id="itemName'+item.id+'"><button type="button" class="btn btn-light btn-sm p-1" title="Remove to cart" id="remove'+item.id+'"><i class="text-danger fa-solid fa-trash-can fa-lg "></i></button><b>' + item.name + '</b></td>\
                                    <td><input type="text" name="food_item_id[]" readonly class="col-lg-3 col-md-3 col-sm-12 form-control" value="' + item.id + '"></td>\
                                    <td><button type="button" class="btn btn-danger btn-sm mr-1" id="decrement' + item.id + '">-</button>\
                                    <input type="number" min=0 max="200" name="quantity[]" id="input_quantity' + item.id + '" width="5px" value="0" class="col-lg-2 col-md-4 col-sm-6 text-center" readonly>\
                                    <button type="button" class="btn btn-success btn-sm ml-1" id="increment' + item.id + '">+</button></td>\
                                    <td><input type="number" min=0 max="200" name="item_price[]" id="cart_item_price' + item.id + '"  value="' + item.price + '" class="col-lg-6 col-md-6 col-sm-12 text-center form-control" readonly> </td>\
                                </tr>');
                                // Attach event listeners for increment and decrement buttons
                                $("#increment" + item.id).click(function() {
                                    var input_quantity = parseInt($("#input_quantity" + item.id).val()) + 1;
                                    $("#input_quantity" + item.id).val(input_quantity);
                                    total_item_price = (item.price * input_quantity);
                                    totalPrice = item.price + totalPrice;
                                    $("#cart_item_price" + item.id).val(total_item_price);
                                    $("#total").val(totalPrice);
                                });
                                
                                $("#decrement" + item.id).click(function(){
                                    var input_quantity = parseInt($("#input_quantity" + item.id).val()) - 1;
                                    if (input_quantity >= 0) {
                                    $("#input_quantity" + item.id).val(input_quantity);
                                    total_item_price = (item.price * input_quantity);
                                    totalPrice = totalPrice - item.price;
                                    $("#cart_item_price" + item.id).val(total_item_price);
                                    $("#total").val(totalPrice);
                                    }
                                });
                                $("#remove"+item.id).click(function(){
                                    //if an item is removed from the cart, its total-item price will be deducted from the total price
                                    if ($("#input_quantity"+item.id).val() > 0) {
                                        totalPrice = totalPrice - $("#cart_item_price"+item.id).val();
                                        console.log(totalPrice);
                                    }    
                                    $("#"+formId).remove();
                                    $("#removeToCart"+item.id).toast("show","autohide:false").fadeIn(100);
                                    //when the an item is removed from cart, the quantity and its respective item-price shall be zero and shall 
                                
                                    
                                    input_quantity = $("#input_quantity"+item.id).val(0);
                                    total_item_price = (item.price * input_quantity);  
                        
                                    //output the updated cart-item-price and total
                                    $("#cart_item_price"+item.id).val(0);
                                    $("#total").val(totalPrice);
                                });
                                
                                $("#description").text("");
                                // append to order description if 
                                $("#submit_order").click(function(){
                                    
                                    $("#description").append($("#itemName"+counter).text() +" - " + "PhP" +  $("#cart_item_price"+counter).val() + " \n");
                                    let change = parseInt($("#payment").val()) - parseInt($("#total").val())    
                                    $("#summary_total").text("Amount Due: PhP " + parseInt($("#total").val()));
                                    $("#summary_change").text("Change: PhP " + change);
                                });
                            
                            }
                            var input_quantity = parseInt($("#input_quantity" + item.id).val()) + 1;
                            $("#input_quantity" + item.id).val(input_quantity);
                            total_item_price = (item.price * input_quantity);
                            totalPrice = item.price + totalPrice;
                            $("#cart_item_price" + item.id).val(total_item_price);
                            $("#total").val(totalPrice);
                            // Submit Order Button

                        }
                    });
                }
                });
                $("#addToCart" + counter).toast("show", "autohide:false").fadeIn(100);
                
            }
            
        
            // function inputFood()
            // {
            //     var total_item_price = 0;
            //     let input_quantity = 1;
            //     $.ajax({
            //         type: "GET",
            //         url: "/fetchFoodItem",
            //         dataType: "json",
            //         success: function(response)
            //         {
            //             //$("tbody#cartContent").html("");
            //             $.each(response.food, function(key, item){
                            
            //                 if($("#"+counter).val() == item.id)
            //                 {       
            //                     console.log(item.name);
            //                     let food = {
            //                         'name': item.name,
            //                         'id': item.id,
            //                         'price': item.price,
            //                     }   
            //                     console.log(food);
            //                     $("tbody#cartContent")
            //                         .append('<tr id="foodRow'+ item.id +'">\
            //                             <td>'+item.name+'</td>\
            //                             <td>'+ '<input type="text" name="food_item_id[]" readonly class="col-lg-3 col-md-3 col-sm-12 form-control" value="'+item.id+'">' +'</td>\
            //                             <td>'+ '<button type="button" class="btn btn-danger btn-sm mr-1" id="decrement'+item.id+'">-</button>\
            //                             <input type="number" min=0 max="200" name="quantity" id="input_quantity'+item.id+'" width="5px" value="1" class="col-lg-2 col-md-4 col-sm-6 text-center" readonly>\
            //                             <button type="button" class="btn btn-success btn-sm ml-1" id="increment'+item.id+'">+</button>' +'</td>\
            //                             <td>\
            //                             <input type="number" min=0 max="200" name="item_price[]" id="cart_item_price'+item.id+'"  value="'+item.price+'" class="col-lg-6 col-md-6 col-sm-12 text-center form-control" readonly>\
            //                             </td></tr>'
            //                     );
            //                     $("#increment"+item.id).click(function(){
            //                         $("#input_quantity"+item.id).val(++input_quantity);
            //                         input_quantity = $("#input_quantity"+item.id).val();
            //                         total_item_price = (item.price * input_quantity);
            //                         totalPrice = item.price + totalPrice;
                        
            //                         $("#cart_item_price"+item.id).val(total_item_price);
            //                         $("#total").val(totalPrice);
            //                     }); 
            //                     $("#decrement"+item.id).click(function(){
            //                         if(input_quantity != -1){
            //                             $("#input_quantity"+item.id).val(--input_quantity);
            //                             input_quantity = $("#input_quantity"+item.id).val();
            //                             total_item_price = (item.price * input_quantity);
            //                             totalPrice = item.price + totalPrice;
                        
            //                             $("#cart_item_price"+item.id).val(total_item_price);
            //                             $("#total").val(totalPrice);
            //                         }
            //                     });
            //                     totalPrice = item.price + totalPrice;
            //                     console.log(totalPrice);
            //                     $("#total").val(totalPrice);
            //                 }
            //             });
            //         }
            //     });  
            //     $("#addToCart"+counter).toast("show","autohide:false").fadeIn(100);
            // }

            // console.log(cart_item_price[counter]);
            $("#"+counter).click(function(){
                inputFood();
            }); 
            

            $("#remove"+counter).click(function(){
                $("#hide"+counter).hide(200);
                $("#removeToCart"+counter).toast("show","autohide:false").fadeIn(100);
                //when the an item is removed from cart, the quantity and its respective item-price shall be zero and shall 
            
                //if an item is removed from the cart, its total-item price will be deducted from the total price
                if ($("#input_quantity"+counter).val() > 0) {
                    total = total - parseInt($("#cart_item_price"+counter).text());
                    console.log(total);
                }    
                
                input_quantity = $("#input_quantity"+counter).val(0);
                total_item_price = (cart_item_price[counter] * input_quantity);  

                //output the updated cart-item-price and total
                $("#cart_item_price"+counter).text(0);
                $("#total").val(total);
            });

            $("#increment"+counter).click(function(){
                $("#input_quantity"+counter).val(++input_quantity);
                input_quantity = $("#input_quantity"+counter).val();
                total_item_price = (cart_item_price[counter] * input_quantity);
                total = parseInt(cart_item_price[counter]) + total;

                $("#cart_item_price"+counter).text(total_item_price);
                $("#total").val(total);
            });  
            
            $("#record_to_summary"+counter).click(function(){   
                $("#description").append($("#item_name"+counter).text() +" - " + "PhP" +  $("#cart_item_price"+counter).text() + " \n");
                order_description.push($("#item_name"+counter).text() + " -- "  + $("#cart_item_price"+counter).text());
                $("#toast_record_summary"+counter).toast("show","autohide:false").fadeIn(100);
            });
        }  

        
    });
</script>

<div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container position-fixed top-0 end-0 p-3"> 
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
    <div class="row my-2">
        <div class="col m-relative">
            <div class="card">
                <div class="card-header">
                    <div class="row position-relative start-0 my-2">
                        <div class="col">
                            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#collapse-category">
                                <i class="fa-solid fa-bars fa-lg"></i> Nonong's Fried Chicken Menu
                            </button>
                        </div>
                    </div>
                    <div class="row collapse show" id="collapse-category">
                        <nav class = "navbar-nav" id="category">
                            <li class="nav-item justify-content-end">
                                @foreach ($categories as $category)
                                    <button type="button" class="btn btn-transapernt btn-sm border border-1 m-2"><a href={{"#".$category->name . $category->id}}> {{$category->name}}</a></button>
                                @endforeach 
                            </li>
                        </nav> 
                    </div>
                </div>
                <div class="card-body p-3 overflow-auto" style="position:static; height:400px;" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#category" tabindex="0">
                    <div class="row">
                        @foreach ($categories as $category)
                            <section class="mt-4" >
                                <h5  id={{$category->name.$category->id}}>{{$category->name}}</h5>
                            </section>
                            @foreach ($data->where('isAvailable', 1) as $item)
                                @if($item->category_id == $category->id)
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                                        <div class="card no-border m-relative justify-content-end">
                                            <button class="btn btn-light" id="{{$item->id}}" value="{{$item->id}}" tooltip="{{$item->name . ' ' . $item->description}}">
                                                <div class="page-content text-center">
                                                    <img class = ""src="{{$item->image ? asset('uploads/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name . " $item->description"}}"alt="item" width="50%" height="50%">
                                                    <section class="overflow-hidden" style="height:50px;">
                                                        <p class="text-center" font size ="2px">{{$item->name . ' '. $item->description}}</p>
                                                    </section>
                                                    <p class="bg-warning justify-content-center d-flex" font size ="2px">P{{$item->price}}</p>
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
    <div class="row mt-2">
        <div class="col text-dark m-relative">
            <div class="card" id="cart" data-aos="fade-left"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <div class="card-header text-muted">Cart Items</div>
                <div class="card-body text-dark overflow-auto" style="position:static; height:300px;">
                    {{-- FORM --}}
                    <form action="{{ route('make_order.store') }}" method="post" class="form" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                            <thead class="bg-warning">
                                <th>Food</th>
                                <th>ID</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </thead>
                            <tbody id="cartContent">
                                {{-- CART CONTENT --}}
                                
                                {{-- @foreach ($data as $item)
                                    <tr id={{'hide'.$item->id}}>
                                        <td>
                                            <button type="button" class="btn btn-light btn-sm p-1" title="Add to Order Summary" id={{"record_to_summary".$item->id}}><i class="fa-solid fa-circle-plus text-success"></i></button>
                                            <button type="button" class="btn btn-light btn-sm p-1" title="Remove to cart" id={{'remove'.$item->id}}><i class="text-danger fa-solid fa-trash-can fa-lg "></i></button>
                                        </td>
                                        <td>
                                            <b id={{"item_name".$item->id}}>{{$item->name}}</b>
                                        </td>
                                        <td>
                                            <input type="text" name="food_item_id[]" readonly class="col-lg-3 col-md-3 col-sm-12 form-control" value="{{$item->id}}"> 
                                        </td> 
                                        <td>
                                                <button type="button" class="btn btn-danger btn-sm mr-1" id={{"decrement".$item->id}}>-</button>
                                                <input type="number" min=0 max="200" name="quantity[]" id={{"input_quantity".$item->id}} width="5px" value="0" class="col-lg-2 col-md-4 col-sm-6 text-center" readonly>
                                                <button type="button" class="btn btn-success btn-sm ml-1" id={{"increment".$item->id}}>+</button>
                                        </td>
                                        <td>
                                                <p id={{"cart_item_price".$item->id}}>{{$item->price}}</p>
                                        </td>
                                    </tr>
                                @endforeach --}}
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
                               <input type="number" name="payment" id="payment" placeholder="&#8369" class="form-control col-lg-4 col-md-4 col-sm-6 text-center">
                                @error('payment')
                                    <div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                                    </div>
                                @enderror
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" id="submit_order" data-bs-target="#submitOrder">
                                    Confirm 
                                </button>
                            </div>
                        </div>
                        
                        <div class="offset-sm-5">
                            {{-- Purposefully empty --}}
                        </div>
                        <!-- Button trigger modal -->
                        
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
                                    <textarea name="description" id="description" readonly cols="30" rows="10" class="form-control"></textarea>
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
                                  <button type="submit" class="btn btn-success">Submit</button>
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
</div>
@endsection
