@extends('staff.layouts.staff-layout')

@section('title','Order History')
@section('content')

<body>
    <div class="foodtext" data-aos="slide-left" delay="500" duration="700">
        <h2>Order History</h2>
    </div>
    {{-- arrange the data from the latest to oldest --}}
    @php
        $orders = DB::table('orders')->latest()->get();
    @endphp 
    <script>
        $(document).ready( function () {
            $('#order_history').DataTable({
                order: [[0,'desc']],
            });
        });
    </script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-13 p-3 text-dark m-relative">
            <div class="card">
                    <div class="card-body text-dark" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500">
                        <section>
                            <table id="order_history" class="table table-striped aos-init aos-animate" data-aos="fade-right" data-aos-delay="500" data-aos-duration="700">
                                <thead>
                                    <tr class="text-center">
                                        <th>Order ID</th>
                                        <th>Date and Time</th>
                                        <th>Order description</th>
                                        <th>Total price</th>
                                        <th>Payment amount</th>
                                        <th>Payment change</th>
                                        <th>Processed by</th>
                                    </tr>
                                </thead>
                                <tbody class="tb text-center">
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            {{$order->id}}
                                        </td>
                                        <td>
                                            {{$order->created_at}}
                                        </td>
                                        <td colspan="1">
                                            <button type="button" class="btn btn-sm dropdown-toggle" title="view description" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-eye text-primary"></i></button>

                                            <div class="dropdown-menu col-lg-4 col-md-8 mt-2 col-sm-12 offset-sm-2" style="font-size:18px;" >
                                                <div class="card-body">
                                                    {{$order->description}}
                                                </div>
                                            </div>     
                                        </td>
                                        <td>
                                            <p class="bg-warning rounded">P {{$order->total_price}}</p>
                                        </td>
                                        <td>
                                            <p class="bg-success rounded">P {{$order->payment}}</p>
                                        </td>
                                        <td>
                                            <b><i><u> &#8369 {{$order->payment_change}}</u></i><b>
                                        </td>
                                        <td>
                                            <p class="bg-success rounded">{{\App\Models\Orders::find($order->id)->user->name}}</p>
                                            {{-- The code above can be done the same as this 
                                                @php
                                                $orders = \App\Models\Orders::find($order->id);

                                                $user = $orders->user->name;
                                                echo $user;
                                            @endphp --}}
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
</body>
@endsection
