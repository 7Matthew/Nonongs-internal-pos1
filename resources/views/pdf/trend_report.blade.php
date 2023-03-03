<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trend Report</title>

    <style>
        .page-break {
            page-break-after: always;
        }

        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          margin-bottom:2.75rem;
          padding:8px;
        }

        #footer { 
            position: fixed; right: 0px; bottom: 10px; text-align: center;border-top: 1px solid black;
        }
        #footer .page:after { 
            content: counter(page, decimal); 
        }
        @page { 
            margin: 20px 30px 40px 50px; 
        }
    </style>
</head> 
<body>
    @php
        $total = 0;
    @endphp
    <div id="footer">
        <p class="page">Page </p>
    </div> 
    <center>
        <img src="images/logo.jpg" width="10%">
       <p><br><b>Nonong's Fried Chicken</b></br> P9-04 3rd 6th, Pasay City, Philippines<br><b>Sales Report</b></br></p>
       From: {{date('F d Y', strToTime($from))}} To: {{date('F d Y', strToTime($to))}}
       
    </center>

    <p>Date Generated:  {{date('F d Y, D')}}</p>
    <table style="border:1px solid black; border-collapse:collapse; padding:0.2rem;" width="100%">
        <thead style="font-size:11px; background-color:yellow;">
            <th>ORDER ID</th>
            <th>Food ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Processed by</th>
            <th>Quantity</th>
            <th>Item Total Price</th>                        
        </thead>
        <tbody>
            @foreach ($orders->whereBetween('created_at', [$from, $to]) as $order)
                @php $order->find($order->id); @endphp
                @foreach ($order->food_item as $food)
                    <tr style="text-align:center; padding:10px;">
                        <td>{{$order->id}}</td>
                        <td>{{$food->id}}</td>
                        <td>{{$food->name}}</td>
                        <td>{{$food->price}}</td>
                        <td>{{$order->user->name}}</td>
                        @php $items = \App\Models\FoodItem_orders::where('food_item_id', $food->id)->get(); @endphp
                        @foreach ($items->where('orders_id',$order->id) as $item)
                            <td>
                                {{floatval($item->quantity)}}
                            </td>
                            <td>
                                {{floatval($item->item_price)}}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                
            @endforeach
        </tbody>
    </table>

    <section>
        <h3>Total Sales: P </h3>
    </section>
</body>
</html>