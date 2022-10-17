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
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Order ID" title="Type in a name"><br><br>
                    <section>
                        <table id="myTable" class="table table-striped aos-init aos-animate" data-aos="fade-right" delay="500" duration="700">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date and Time</th>
                                    <th>Name</th>
                                    <th>Mode of Payment</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody class="tb">
                                <tr>
                                    <td>#2632</td>
                                    <td>08/18/22 | 10:04</td>
                                    <td>Joe Mama</td>
                                    <td>Cash</td>
                                    <td>369.00</td>
                                </tr>
                                <tr>
                                    <td>#2633</td>
                                    <td>08/18/22 | 10:31</td>
                                    <td>Brooklyn Zoe</td>
                                    <td>Cash</td>
                                    <td>99.00</td>
                                </tr>
                                <tr>
                                    <td>#2634</td>
                                    <td>08/18/22 | 12:19</td>
                                    <td>Austin Lo</td>
                                    <td>GCash</td>
                                    <td>673.00</td>
                                </tr>   
                                <tr>
                                    <td>#2635</td>
                                    <td>08/18/22 | 14:01</td>
                                    <td>Ana Van</td>
                                    <td>Cash</td>
                                    <td>1089.00</td>
                                </tr> 
                                <tr>
                                    <td>#2636</td>
                                    <td>08/18/22 | 16:45</td>
                                    <td>Ya Chin</td>
                                    <td>GCash</td>
                                    <td>176.00</td>
                                </tr> 
                                <tr>
                                    <td>#2637</td>
                                    <td>08/18/22 | 8:03</td>
                                    <td>Fuji Bose</td>
                                    <td>Cash</td>
                                    <td>78.00</td>
                                </tr> 
                                <tr>
                                    <td>#2638</td>
                                    <td>08/19/22 | 8:24</td>
                                    <td>Leica Ri</td>
                                    <td>Cash</td>
                                    <td>935.00</td>
                                </tr>  
                                <tr>
                                    <td>#2639</td>
                                    <td>08/19/22 | 9:30</td>
                                    <td>Charles Green</td>
                                    <td>Cash</td>
                                    <td>212.00.00</td>
                                </tr>  
                                <tr>
                                    <td>#2640</td>
                                    <td>08/20/22 | 9:14</td>
                                    <td>Joseph Baker</td>
                                    <td>Cash</td>
                                    <td>89.00</td>
                                </tr>  
                                <tr>
                                    <td>#2641</td>
                                    <td>08/20/22 | 1:18</td>
                                    <td>Thomas Adams</td>
                                    <td>Cash</td>
                                    <td>789.00</td>
                                </tr>  
                                <tr>
                                    <td>#2642</td>
                                    <td>08/20/22 | 2:23</td>
                                    <td>Mark Campbell</td>
                                    <td>GCash</td>
                                    <td>1067.00</td>
                                </tr>  
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
      table = document.getElementById("myTable");
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
