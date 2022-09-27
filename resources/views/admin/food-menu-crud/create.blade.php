@extends('admin.layouts.admin-layout')

@section('title','Food Menu - Create New Item')
@section('content')

<body>
  <div class="card" style="width:50em; margin-top:3em; margin-left:14em;">
    <div class="card-header">New Item</div>
    <div class="card-body">
       
        <form action="{{ route('food-item.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <label for="name">Name</label></br>
          <input type="text" name="name" id="name" class="form-control" value ="{{old('name')}}"></br>
          @error('name')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <label for="price">Price</label></br>
          <input type="number" name="price" id="price" class="form-control" value ="{{old('price')}}"></br>
          @error('price')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <label for="stocks">Stocks</label></br>
          <input type="number" name="stocks" id="stocks" class="form-control" value ="{{old('stocks')}}"></br>
          @error('stocks')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <label for="food-image">Food image</label></br>
          <input type="file" name="food-image" class="form-control" accept="image/png, image/gif, image/jpeg" value ={{old('food-image')}}></br>
          @error('food-image')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <input type="submit" value="Save" class="btn btn-success mt-2"></br>
      </form>
      
    </div>
  </div>

@endsection
