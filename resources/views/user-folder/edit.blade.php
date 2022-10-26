@extends('admin.layouts.admin-layout')

@section('title','Edit Users')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">

        </div>
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-header">
                    Edit User
                </div>
                <form method="POST" class="mt-4" action="{{ route('manage-users.update', ['manage_user'=> $user->id]) }}" enctype="multipart/form-data">
                    <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
            
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
            
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
            
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
            
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
            
                                <div class="col-md-6">
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username">
            
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Make Admin?') }}</label>
                                <select id="role" name="role" class="col-md-6 form">
                                    <option value="0">Admin</option>
                                    <option value="1">Staff</option>
                                </select>
                            </div>
            
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> {{ __('Save') }} </button>
                        <a  href="{{route('manage-users.index')}}"><button type="button" class="btn btn-primary">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col">

        </div>
    </div>
</div>
@endsection