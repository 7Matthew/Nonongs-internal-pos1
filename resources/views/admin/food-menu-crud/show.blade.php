@extends('admin.layouts.admin-layout')

@section('title','Food Menu - Add Item')
@section('content')

<body>
  <div class="card" style="width:35rem; margin-top:5em; margin-left:20em;">
    <div class="card-header"><b>{{$food->name}}</b></div>
    <div class="card-body">
        <div class="page-content justify-content">
            <h3>
                {{$food->name}}
            </h3>
            <h4>
                ID: {{$food->id}}
            </h4>
            <h4>
                Price: {{$food->price}}
            </h4>
            <h4>
                Stocks: {{$food->stocks}}
            </h4>
        </div>
        <a href="{{route('food-item.edit', $food->id)}}" title="Edit item"><button class="btn btn-primary btn-sm mt-2"><i class="fa-regular fa-pen-to-square"></i></button>
        </a>
        <form method="POST" action="{{ route('food-item.destroy', $food->id) }}" accept-charset="UTF-8" style="display:inline">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger btn-sm mt-2" title="Delete item" onclick="return confirm('Confirm Delete?')"><i class="fa-solid fa-trash"></i></button>
        </form>
        <a href="{{ route('food-item.index') }}" class="btn btn-success btn-sm mt-2">Back</a>
    </div>
  </div>

@endsection
