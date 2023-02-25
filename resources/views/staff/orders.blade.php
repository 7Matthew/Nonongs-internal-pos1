@extends('staff.layouts.staff-layout')

@section('title','Order History')
@section('content')

<div class="container-fluid mt-2">
    {{-- arrange the data from the latest to oldest --}}
    @php
        $orders = DB::table('orders')->latest()->get();
    @endphp 
    <script>
        $(document).ready( function () {
            $('#order_history').DataTable({
                order: [[0,'desc']],
                responsive: true,
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
                "scrollY": "50vh",
                "scrollCollapse": true,
                "paging": true
            });
        });
    </script>
    <div class="row mb-3">
        <div class="col m-relative">
            <div class="card">
                <div class="card-header">
                    <span class="card-text">
                        <h6>Order History Table</h6>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 p-3 text-dark m-relative">
                            <table id="order_history" class="table col-lg-12 col-md-12 col-sm-6 table-striped dtr-inline collapsed   aos-init aos-animate" data-aos="fade-right" data-aos-delay="500" data-aos-duration="700">
                                <thead>
                                    <tr class="text-center">
                                        <th>Order ID</th>
                                        <th>Date and Time</th>
                                        <th>Order description</th>
                                        <th>Total price</th>
                                        <th>Payment amount</th>
                                        <th>Payment change</th>
                                        <th>Payment Status</th>
                                        <th>Payment Method</th>
                                        <th>Processed by</th>
                                        <th>Action</th>
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
                                                <p>&#8369 {{$order->total_price}}</p>
                                            </td>
                                            <td>
                                                <p>&#8369 {{$order->payment}}</p>
                                            </td>
                                            <td>
                                                <b><i><u> &#8369 {{$order->payment_change}}</u></i><b>
                                            </td>
                                            <td>
                                                @if ($order->paymentStatus == 'Paid')
                                                   <p class="bg-success">{{strval($order->paymentStatus)}}</p> 
                                                @else   
                                                    <p class="bg-danger">{{strval($order->paymentStatus)}}</p> 
                                                @endif
                                                
                                            </td>
                                            <td>
                                                @if ($order->paymentStatus == 'Paid')
                                                    {{$order->modeOfPayment}} 
                                                @else   
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                <p>{{\App\Models\Orders::find($order->id)->user->name}}</p>
                                                {{-- The code above can be done the same as this 
                                                    @php
                                                    $orders = \App\Models\Orders::find($order->id);
            
                                                    $user = $orders->user->name;
                                                    echo $user;
                                                @endphp --}}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target={{"#modal-edit-order".$order->id}} title="Edit order {{$order->id}}"><i class="fa-regular fa-pen-to-square"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@foreach ($orders as $item)
        <div class="modal fade" id={{"modal-edit-order".$item->id}} tabindex="-1" aria-labelledby="modal-edit-food-item" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
                <div class="modal-content">
                    <div class="modal-header bg-alert bg-warning" >
                        <h1 class="modal-title fs-4" id="modal-confirm-order">Edit Order # {{$item->id}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('make_order.update', ['make_order'=> $item->id])}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body p-5">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                        <label for="payment" class="form-label">Payment</label>
                                    </div> 
                                    <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                                        <input type="number" name="payment" placeholder=&#8369 id="payment" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                        <label for="modeOfPayment" class="form-label">Payment Method</label>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                                        <select name="modeOfPayment" id="modeOfPayment" class="form-select">
                                            <option value="Cash">Cash</option>
                                            <option value="GCash">GCash</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-primary btn-sm">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
