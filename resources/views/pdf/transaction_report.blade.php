<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction Report</title>

    <style>
        .page-break {
            page-break-after: always;
        }

        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          margin-bottom:2.75rem;
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
    <div id="footer">
        <p class="page">Page </p>
    </div> 
    <center>
        <img src="images/logo.jpg" width="10%">
       <h4>Nonong's Fried Chicken</h4>
       <p>P9-04 3rd 6th, Pasay City, Philippines</p>
       From: {{date('F d Y', strToTime($from))}} To: {{date('F d Y', strToTime($to))}}
    </center>

    <p>Date Generated:  {{date('F d Y, D')}}</p>
    <table style="border:1px solid black; border-collapse:collapse; padding:0.2rem;">
        <thead style="font-size:11px; background-color:yellow;">
            <th>Order ID</th>
            <th>Date and Time</th>
            <th>Order description</th>
            <th>Total price</th>
            <th>Payment Status</th>
            <th>Payment Method</th>
            <th>Payment amount</th>
            <th>Payment change</th>
            <th>Processed by</th>                           
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr style="text-align:center;">
                    <td>{{$item->id}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->total_price}}</td>
                    <td>{{$item->paymentStatus}}</td>
                    <td>{{$item->modeOfPayment}}</td>
                    <td>{{$item->payment}}</td>
                    <td>{{$item->payment_change}}</td>
                    <td>{{$item->user->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>