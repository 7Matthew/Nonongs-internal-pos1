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
            <button type="button" class="btn btn-danger btn-sm mt-2" title="Delete item" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="modal-confirm-order" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header d-flex pb-5">
                      <h1 class="modal-title fs-5" id="modal-confirm-order">Confirm Deletion of {{ $food->name }}?</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
        <a href="{{ route('food-item.index') }}" class="btn btn-success btn-sm mt-2">Back</a>
    </div>
  </div>

@endsection
