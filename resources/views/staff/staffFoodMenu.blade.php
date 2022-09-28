@extends('staff.layouts.staff-layout')

@section('title','Food Menu')
@section('content')


<body>
    <div class="foodtext">
    <h2>FOOD MENU</h2>
    <br>
    <h3>Menu List</h3>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-13 p-5 text-dark m-relative">
        <div class="card">
                <div class="card-body text-dark">
                    <div class="card-body">
                        <a href="{{ route('food-item.create')}}" class="btn btn-success btn-sm" title="Add Menu">
                            Add Item
                        </a>
                        @if(Session::has('success'))
                            <div class="alert alert-success text-dark mt-4 p-auto " role="alert">
                                {{ 'Success!' }}
                            </div>
                        @endif
                        @if(Session::has('edit-success'))
                            <div class="alert alert-success text-dark mt-4 p-auto " role="alert">
                                {{ 'Item Edited Successfully!' }}
                            </div>
                        @endif
                        <div class="table-responsive mt-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th> 
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stocks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                @foreach ($data as $item)
                                <tbody>
                                    <tr>
                                        <td>{{ $item->id }}</td> 
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->stocks }}</td>
  
                                        <td>
                                            <a href="{{ route('food-item.show',['food_item' => $item['id']])}}" title="View item"><button class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{route('food-item.edit', $item->id)}}" title="Edit item"><button class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></button></a>
  
                                            <form method="POST" action="#" accept-charset="UTF-8" style="display:inline">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete item"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                <!--
                    <p>LAGAY KA DITO NG Create And Delete for an item in the food menu</p>
                    <p>dsvjkndfiovdkvmfidovkxm c kmckkdfvkfv kivndfskjnviovnkvmkldsfmvoedklm kdf kdfv kdmv kdsmv mfd njkfdnjdsfnv </p> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
