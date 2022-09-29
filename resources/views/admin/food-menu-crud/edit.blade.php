@extends('admin.layouts.admin-layout')

@section('title','Food Menu - Edit Item')
@section('content')

<body>
  <div class="card" style="width:50em; margin-top:3em; margin-left:14em;">
    <div class="card-header">Edit Item</div>
    <div class="card-body">
       
        <form action="{{route('food-item.update', ['food_item'=> $food->id])}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <label>Name</label></br>
          <input type="text" name="name" id="name" class="form-control" value ="{{$food->name}}"></br>
          @error('name')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <label>Price</label></br>
          <input type="number" name="price" id="price" class="form-control" value ="{{$food->price}}"></br>
          @error('price')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <label>Stocks</label></br>
          <input type="number" name="stocks" id="stocks" class="form-control" value ="{{$food->stocks}}"></br>
          @error('stocks')
            <div class="alert alert-danger" role="alert">
              <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
            </div>
          @enderror
          <label for="image">Food image</label></br>
          <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg" value ={{$food['image']}}></br>
          <input type="submit" value="Save" class="btn btn-success"> 
          <a href="{{ route('food-item.index') }}" class="btn btn-primary">Cancel</a>
      </form>
      
    </div>
  </div>

@endsection
