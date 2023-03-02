@extends('admin.layouts.admin-layout')

@section('title','Dashboard')
@section('content')
<div class="container-fluid">
  @php
    $expired_items = \App\Models\Item::where('expiry_date', '<=', date('Y-m-d'))->take(3)->get();
    $recent_items =  \App\Models\Item::latest()->take(3)->get();
    $trend = \App\Models\FoodItem::take(5)->get();
    $lowstock_items = \App\Models\Item::where('quantity', '<=', 1)->take(3)->get();
    $today_sales = DB::table('orders')->whereDate('created_at', date('Y-m-d'))->get()->where('paymentStatus', '==', 'Paid');
    $month_sales = DB::table('orders')->whereMonth('created_at', date('m'))->get()->where('paymentStatus', '==', 'Paid');
    $today_total = 0;
    $month_total = 0;
  @endphp
  <div class="row my-4">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <!-- small box -->
      <div class="small-box hover-transform" style="background-image: linear-gradient(to bottom, rgb(218, 251, 84), rgb(251, 193, 31))">
        <div class="inner">
          <h6 class="mb-3">{{date('F Y')}}</h6>
          @php
            foreach($month_sales as $sales)
            {
              $month_total = (int)$sales->total_price + $month_total;
            }
          @endphp
          <h2>&#8369 {{$month_total}}</h2>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars text-light"></i>
        </div>
        <div class="small-box-footer">
          Total Monthly Sales
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <!-- small box -->
      <div class="small-box hover-transform" style="background-image: linear-gradient(to bottom, rgb(236, 255, 177), rgb(183, 255, 0))">
        <div class="inner">
          <h6 class="mb-3">{{date('F Y')}}</h6>
          @php
              $staff = DB::table('users')->get()->where('role','==','1');
          @endphp
          <h2>{{count($month_sales)}} Orders</h2>
        </div>
        <div class="icon">
          <i class="fa-solid fa-drumstick-bite text-light"></i>
        </div>
        <div class="small-box-footer">
          This month's Orders
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <!-- small box -->
      <div class="small-box hover-transform" style="background-image: linear-gradient(to bottom, rgb(193, 193, 255), cyan)" >
        <div class="inner">
          <h6 class="mb-3">{{date('M d Y, D ')}}</h6>
          @foreach ($today_sales as $sales)
            @php
                $today_total = (int)$sales->total_price + $today_total;
            @endphp
          @endforeach
          <h2> &#8369 {{$today_total}} </h2>
        </div>
        <div class="icon">
          <i class="ion ion-bag text-light"></i>
        </div>
        <div class="small-box-footer">
          Today's total Sales
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <!-- small box -->
      <div class="small-box hover-transform" style="background-image: linear-gradient(to bottom, rgb(218, 251, 84), rgb(251, 193, 31))">
        <div class="inner">
          <h6 class="mb-3">{{date('M d Y, D ')}}</h6>

          <h2>{{count($today_sales)}} Orders </h2>
        </div>
        <div class="icon">
          <i class="fa-solid fa-drumstick-bite text-light"></i>
        </div>
        <div class="small-box-footer">
          Today's Orders
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <!-- small box -->
      <div class="small-box hover-transform" style="background-image: linear-gradient(to bottom, rgb(236, 255, 177), rgb(183, 255, 0))">
        <div class="inner">
          <h6 class="mb-3">{{date('F Y')}}</h6>
          @php
              $staff = DB::table('users')->get()->where('role','==','1');
          @endphp
          <h2> {{count($staff)}} Staffs </h2>
        </div>
        <div class="icon">
          <i class="fa fa-user text-light"></i>
        </div>
        <div class="small-box-footer">
          Staff
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
      <!-- small box -->
      <div class="small-box hover-transform" style="background-image: linear-gradient(to bottom, rgb(193, 193, 255), cyan)">
        <div class="inner">
          <h6 class="mb-3">{{date('F Y')}}</h6>
          @php
          $admin = DB::table('users')->get()->where('role','==','0');
          @endphp
        <h2>  {{count($admin)}} Admins </h2>
        </div>
        <div class="icon">
          <i class="fa fa-user text-light"></i>
        </div>
        <div class="small-box-footer">
          Admin 
        </div>
      </div>
    </div>  
    <div class="overflow-auto hover-transform col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-header bg-gradient-danger text-light no-border" >
            <p class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Low stock Item</p>
        </div>
        <div class="card-body bg-gradient-danger text-light no-border">
          <section class="overflow-auto" style="height:200px;">
            @if (count($lowstock_items) == 0)
              <section class="text-muted text-center m-5">
                <i> <h3>No data to show yet</h3> </i>
              </section>
            @else
              <table class="table no-border table-striped table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($lowstock_items as $item)
                    <tr>
                      <td class="text-light">{{$item->name}}</td>
                      <td class="text-light">{{floatval($item->quantity). " $item->measuring_unit"}}</td>
                      <td class="text-light"> &#8369 {{floatval($item->cost)}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </section>
        </div>
        <div class="card-footer bg-gradient-danger opacity-75 text-light text-right">
          <a href="/inventory" class="btn text-light">More Info <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <div class="overflow-auto hover-transform col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-header bg-gradient-danger text-light no-border">
            <p class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Expired Items</p>
        </div>
        <div class="card-body bg-gradient-danger text-light no-border">
          <section class="overflow-auto" style="height:200px;">
            @if (count($expired_items) == 0)
              <section class="text-muted text-center m-5">
                <i> <h3>No data to show yet</h3> </i>
              </section>
            @else
              <table class="table no-border table-striped table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Expired on</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($expired_items as $item)
                    <tr>
                      <td class="text-light">{{$item->name}}</td>
                      <td class="text-light">{{floatval($item->quantity). " $item->measuring_unit"}}</td>
                      <td class="text-light"> &#8369 {{floatval($item->cost)}}</td>
                      <td class="text-light">
                        @php
                            $expiry = date_create($item->expiry_date);

                            $expiry = date_format($expiry, 'm-d-y'); 
                            echo $expiry; 
                        @endphp
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </section>
        </div>
        <div class="card-footer bg-gradient-danger opacity-75 text-light text-right">
          <a href="/inventory" class="btn text-light">More Info <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <div class="overflow-auto hover-transform col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-header bg-gradient-success text-light border-0" >
            <p class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Recently Added Items</p>
        </div>
        <div class="card-body bg-gradient-success text-light border-0">
          <section class="overflow-auto text-center" style="height:200px;">
            <table class="table table-striped table-hover no-border">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Cost</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($recent_items as $item)
                  <tr>
                    <td class="text-light">{{$item->name}}</td>
                    <td class="text-light">{{$item->quantity . " $item->measuring_unit"}}</td>
                    <td class="text-light">&#8369 {{$item->cost}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </section>
        </div>
        <div class="card-footer bg-gradient-success opacity-75 text-right">
          <a href="/inventory" class="btn text-light">More Info <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready( function () {
        $('#trends').DataTable({
            order: [[0,'desc']],
            "responsive": true, 
            "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
            "scrollY": "50vh",
            "scrollCollapse": true,
            "paging": true,
        });
    });
</script>
</div> 
@endsection
