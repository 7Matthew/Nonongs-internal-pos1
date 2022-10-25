@extends('admin.layouts.admin-layout')

@section('title','Dashboard')
@section('content')
<div class="container-fluid">

<a href="{{route('create-new-user')}}"><h1>users</h1></a>
<table class="table no-border">
    <tr >
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    @foreach ($user as $item)
    <tr >    
        <td>{{ucwords($item->name)}}</td>
        <td>{{$item->username}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->role}}</td>
        
    </tr>
    @endforeach
</table>
@endsection
