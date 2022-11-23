var total_item_price;
var total = 0; 
var cart_item_price = []; // from database

$(document).ready(function(){
    
    for (let counter = 0; counter < 100; counter++) {
        
        let input_quantity = 0;
        cart_item_price.push($("#cart_item_price"+counter).text()); // inserting values to cart_item_price variable using the value from the html text $item->price
        // console.log(cart_item_price[counter]);
        
        $("#"+counter).click(function(){
            $("#hide"+counter).show(300);
            $("#addToCart"+counter).toast("show","autohide:false").fadeIn(100);
            input_quantity = $("#input_quantity"+counter).val();// initialize input quantity
        });
        $("#remove"+counter).click(function(){
            $("#hide"+counter).hide(200);
            $("#removeToCart"+counter).toast("show","autohide:false").fadeIn(100);
            //when the an item is removed from cart, the quantity its respective price shall be zero
            input_quantity = $("#input_quantity"+counter).val(0);
            total_item_price = (cart_item_price[counter] * input_quantity);
            $("#cart_item_price"+counter).text(0);
        });

        $("#decrement"+counter).click(function(){
            if(input_quantity != -1){
            $("#input_quantity"+counter).val(--input_quantity);
            input_quantity = $("#input_quantity"+counter).val();
            total_item_price = (cart_item_price[counter] * input_quantity);
            // console.log("total price: " + total_item_price);
            // $("#total_item_price"+counter).text(total_item_price);
            $("#cart_item_price"+counter).text(total_item_price);
            $("#total"+counter).text(total_item_price);
            }
        });
        $("#increment"+counter).click(function(){
            $("#input_quantity"+counter).val(++input_quantity);
            input_quantity = $("#input_quantity"+counter).val();
            total_item_price = (cart_item_price[counter] * input_quantity);
            // console.log("total price: " + total_item_price);
            // $("#total_item_price"+counter).text(total_item_price);
            $("#cart_item_price"+counter).text(total_item_price);
            $("#total"+counter).text(total_item_price);
        }); 

        $("input#input_quantity"+counter).on({
            "change": function (){
                input_quantity = $("#input_quantity"+counter).val();
                total_item_price = (cart_item_price[counter] * input_quantity);
                // console.log("total price: " + total_item_price);
                // $("#total_item_price"+counter).text(total_item_price);
                $("#cart_item_price"+counter).text(total_item_price);
            },
            "focus": function (){
                input_quantity = $("#input_quantity"+counter).val();
                total_item_price = (cart_item_price[counter] * input_quantity);
                // console.log("total price: " + total_item_price);
                // $("#total_item_price"+counter).text(total_item_price);
                $("#cart_item_price"+counter).text(total_item_price);
            },

        }); 
        
            
       

        
    }  
});
