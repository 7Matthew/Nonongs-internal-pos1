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
       <p><br><b>Nonong's Fried Chicken</b></br> P9-04 3rd 6th, Pasay City, Philippines<br><b>Trend Report</b></br>These are the list of what items are often purchased</p>
       From: {{date('F d Y', strToTime($from))}} To: {{date('F d Y', strToTime($to))}}
       
    </center>

    <p>Date Generated:  {{date('F d Y, D')}}</p>
    <table style="border:1px solid black; border-collapse:collapse; padding:0.2rem;" width="100%">
        <thead style="font-size:11px; background-color:yellow;">
            <th>Food ID</th>
            <th>Name</th>
            <th>Item Price</th>                        
            <th>No. of Orders</th>      
        </thead>
        <tbody>
            @foreach ($foods->filter(function($item) use ($from, $to) {
                return $item->orders->whereBetween('created_at', [$from, $to])->count() > 0;
            })->sortByDesc(function($item) use ($from, $to) {
                return $item->orders->whereBetween('created_at', [$from, $to])->count();
            }) as $item)
                @php
                    $count_orders = $item->orders->whereBetween('created_at', [$from, $to])->count();
                @endphp
                @if ($count_orders != 0)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>P {{$item->price}}</td>
                        <td>{{$count_orders}}</td>
                    </tr>  
                @endif
            @endforeach
         
        </tbody>
    </table>
</body>
</html>
