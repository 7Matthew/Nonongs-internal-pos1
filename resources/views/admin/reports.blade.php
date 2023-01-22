@extends('admin.layouts.admin-layout')

@section('title','Forecasting')
@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col p-5 text-dark m-relative">
            <div class="card">
                <div class="card-header">
                    <h6>Generate Transaction Report</h6>
                </div>
                <div class="card-body">
                    <form id="transaction_report" action="{{route('transaction_report')}}" method="get" enctype="multipart/form-data">
                        <div class="row mb-2">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                                <label for="from">Date from: </label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <input type="date" name="from" class="form-control">
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                                <label for="to">Date to: </label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <input type="date" name="to" class="form-control">
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-2 col-xs-2 mt-2">
                                <button type="submit" class="btn btn-success btn-sm">Generate Report</button>
                            </div>
                        </div>
                    </form>
                    {{-- JS Submit Function --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection