<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory Report</title>

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
    <div id="footer">
        <p class="page">Page </p>
    </div> 
    <center>
        <img src="{{asset('images/logo.jpg')}}" width="10%">
       <p><br><b>Nonong's Fried Chicken</b></br> P9-04 3rd 6th, Pasay City, Philippines<br><b>Inventory Report</b></br></p>
       From: {{date('F d Y', strToTime($from))}} To: {{date('F d Y', strToTime($to))}}
       
    </center>

    <p>Date Generated:  {{date('F d Y, D')}}</p>
    <table style="border:1px solid black; border-collapse:collapse; padding:0.2rem;">
        <thead style="font-size:11px; background-color:yellow;">
            <th>Item ID</th>
            <th>Name</th>
            <th>Supplier</th>
            <th>Category</th>
            <th>Added by</th>
            <th>quantity</th>
            <th>Cost</th>
            <th>Expiry</th>                            
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr style="text-align:center; padding:10px;">
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->supplier->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->quantity . " $item->measuring_unit"}}</td>
                    <td>P{{$item->cost}}</td>
                    <td>{{$item->expiry_date}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>