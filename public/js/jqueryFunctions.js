var total_item_price = 0;
var total = 0; 
var cart_item_price = []; // from database
var order_price_container = []; // a container for the price of a clicked/selected item
const date = new Date();
var order_description = [];

$(document).ready(function(){
    
    for (let counter = 0; counter < 100; counter++) {
        
        let input_quantity = 0;
        cart_item_price.push($("#cart_item_price"+counter).text()); // inserting values to cart_item_price variable using the value from the html text $item->price
        let hide_elements = $("#hide"+counter).hide();//initially hide all the table data
        
        // console.log(cart_item_price[counter]);
        
        $("#"+counter).click(function(){
            $("#hide"+counter).show(300);//show the specific element and set its visibility property to visible
            $("#addToCart"+counter).toast("show","autohide:false").fadeIn(100);
            input_quantity = $("#input_quantity"+counter).val();// initialize input quantity
            console.log("price: " + cart_item_price[counter]);
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

        
        
        $("#decrement"+counter).click(function(){
            if(input_quantity != -1){
                $("#input_quantity"+counter).val(--input_quantity);
                input_quantity = $("#input_quantity"+counter).val();
                total_item_price = (cart_item_price[counter] * input_quantity);
                total = total - cart_item_price[counter];

                $("#cart_item_price"+counter).text(total_item_price);
                $("#total").val(total);
            }
        });
        
        $("#record_to_summary"+counter).click(function(){   
            $("#description").append($("#item_name"+counter).text() +" - " + "PhP" +  $("#cart_item_price"+counter).text() + " \n");
            order_description.push($("#item_name"+counter).text() + " -- "  + $("#cart_item_price"+counter).text());
        });
        
       //once na ma click ang submit, dapat lahat nung item na nakasulat ay marerecord dapat sa order summary
        
        $("#submit_order").click(function(){
            if(parseInt($("#total").val()) > parseInt($("#payment").val()))
            {
                console.log("Insufficient Payment!");
            }
            
            let change = parseInt($("#payment").val()) - parseInt($("#total").val())
            $("#summary_total").text("Amount Due: PhP " + parseInt($("#total").val()));
            $("#summary_change").text("Change: PhP " + change);
            
        });

        //fix this part may bug pa
        $("input#input_quantity"+counter).on({
            "change": function (){
                input_quantity = $("#input_quantity"+counter).val();
                console.log("value: " + input_quantity + "Type: " + typeof(input_quantity));
                total_item_price = (parseInt(cart_item_price[counter]) * parseInt(input_quantity));
                total = parseInt(total_item_price) + total;
 
                $("#cart_item_price"+counter).text(total_item_price);
                $("#total").val(total);
            },
        }); 
        
    }  

    
});
