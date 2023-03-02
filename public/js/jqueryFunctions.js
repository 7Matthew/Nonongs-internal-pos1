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
