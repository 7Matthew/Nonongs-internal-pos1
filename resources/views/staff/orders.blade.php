@extends('staff.layouts.staff-layout')

@section('title','Order History')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<body>
    <div class="foodtext" data-aos="slide-left" delay="500" duration="700">
        <h2>Order History</h2>
        <br>
        <h3>Manage your recent orders and invoices</h3>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-13 p-3 text-dark m-relative">
        <div class="card">
                <div class="card-body text-dark" data-aos="flip-right" delay="1000" duration="2000">
                    <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search Order ID" title="Type an order ID"><br><br>
                    <section>
                        <table id="order_history" class="table table-striped aos-init aos-animate" data-aos="fade-right" delay="500" duration="700">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date and Time</th>
                                    <th>Order description</th>
                                    <th>Total price</th>
                                    <th>Payment amount</th>
                                    <th>Payment change</th>
                                    <th>Processed by</th>
                                </tr>
                            </thead>
                            <tbody class="tb">
                                @foreach ($data as $order)
                                <tr>
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                    <td colspan=1>
                                        <button type="button" class="btn btn-warning btn-sm" title="view description"><i class="fa-solid fa-eye"></i></button>
                                    </td>
                                    <td>
                                        P {{$order->total_price}}
                                    </td>
                                    <td>
                                        P {{$order->payment}}
                                    </td>
                                    <td>
                                        P {{$order->payment_change}}
                                    </td>
                                    <td>
                                        {{gettype($order->id->name)}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </section>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("order_history");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
    </script>
</body>
@endsection
