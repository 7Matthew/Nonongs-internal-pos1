@extends('staff.layouts.staff-layout')

@section('title','Change Password')
@section('content')
<div class="container-fluid">
    @if(Session::has('success'))
        <script>
            $(document).ready(function(){
                $("#success_message").toast("show","autohide:true").fadeIn(80);
            });
        </script>
    @elseif(Session::has('failed'))
        <script>
            $(document).ready(function(){
                $("#error_message").toast("show","autohide:true").fadeIn(80);
            });
        </script>
    @endif
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast align-items-center text-bg-success border-0" id="success_message" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-bell fa-lg"></i> {{"Success"}}!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="toast align-items-center text-bg-danger border-0" id="error_message" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-bell fa-lg"></i> {{"Failed"}}!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-3 content-center p-5 m-relative">
        <div class="col">
            <div class="card shadow">
                <div class="card-header"> 
                    {{-- style="background-image: linear-gradient(to bottom right, red, white,white, rgb(250, 166, 55))" --}}
                    <h3>Change Password</h3>
                </div>
                <form action="{{route('update_password')}}" method="POST" class="form">
                    @csrf
                    <div class="card-body p-5">
                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <label for="old_passowrd" class="form-label">Old Password</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6 ">
                                <input type="password" name="old_password" class="form-control" required autofocus placeholder="Enter old password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <label for="password" class="form-label">New Password</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                <input type="password" name="password" class="form-control" required autofocus placeholder="Enter new password">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                <label for="password_confirmation" class="form-label">Confirm new Password</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                                <input type="password" name="password_confirmation" class="form-control" required autofocus placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end p-3">
                        <button type="submit" class="btn btn-success"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection