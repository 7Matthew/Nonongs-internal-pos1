@extends('admin.layouts.admin-layout')

@section('title','Dashboard')
@section('content')
<div class="container-fluid">
  <section class="content">
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h6 class="mb-3">{{date('F Y')}}</h6>
              @php
                $today_sales = DB::table('orders')->whereDate('created_at', date('Y-m-d'))->get()->where('paymentStatus', '==', 'Paid');
                $month_sales = DB::table('orders')->whereMonth('created_at', date('m'))->get()->where('paymentStatus', '==', 'Paid');
                $today_total = 0;
                $month_total = 0;
              @endphp
              @php
                foreach($month_sales as $sales)
                {
                  $month_total = (int)$sales->total_price + $month_total;
                }
              @endphp
              <h2>&#8369 {{$month_total}}</h2>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <div class="small-box-footer">
              Total Monthly Sales
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h6 class="mb-3">{{date('F Y')}}</h6>
              @php
                  $staff = DB::table('users')->get()->where('role','==','1');
              @endphp
              <h2>{{count($month_sales)}}</h2>
            </div>
            <div class="icon">
              <i class="fa fa-user text-light"></i>
            </div>
            <div class="small-box-footer">
              This month's Orders
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h6 class="mb-3">{{date('M d Y, D ')}}</h6>
              @foreach ($today_sales as $sales)
                @php
                    $today_total = (int)$sales->total_price + $today_total;
                @endphp
              @endforeach
              <h2> &#8369 {{$today_total}}</h2>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <div class="small-box-footer">
              Today's total Sales
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h6 class="mb-3">{{date('M d Y, D ')}}</h6>

              <h2>{{count($today_sales)}} Orders</h2>
            </div>
            <div class="icon">
              <i class="fa-solid fa-drumstick-bite"></i>
            </div>
            <div class="small-box-footer">
              Today's Orders
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h6 class="mb-3">{{date('F Y')}}</h6>
              @php
                  $staff = DB::table('users')->get()->where('role','==','1');
              @endphp
              <h2>{{count($staff)}}</h2>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <div class="small-box-footer">
              Staff
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h6 class="mb-3">{{date('F Y')}}</h6>
              @php
              $admin = DB::table('users')->get()->where('role','==','0');
              @endphp
            <h2>{{count($admin)}}</h2>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <div class="small-box-footer">
              Admin 
            </div>
          </div>
        </div>  
        <div class="overflow-auto col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-header bg-danger">
                <p class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Low stock Foods</p>
            </div>
            <div class="card-body">
              
            </div>
          </div>
        </div>
        <div class="overflow-auto col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-header bg-danger">
                <p class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Expired Items</p>
            </div>
            <div class="card-body">
  
            </div>
          </div>
        </div>
        <div class="overflow-auto col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="card">
            <div class="card-header bg-danger">
                <p class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Recently Added Items</p>
            </div>
            <div class="card-body">
  
            </div>
          </div>
        </div>
      <div class="row">
        
      </div>
    </div>
  </section>
  
</div>
@endsection
