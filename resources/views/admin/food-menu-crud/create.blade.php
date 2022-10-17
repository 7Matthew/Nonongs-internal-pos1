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
          <label for="category">Category</label></br>
          <select name ="category" id="category" class="form-control" value ="{{old('category')}}">
              <option></option>
              <option value="fried-chicken">Fried Chicken</option>
              <option value="rice-meals">Rice Meals</option>
              <option value="soup"> Soup </option>
              <option value="rice"> Rice </option>
              <option value="other-specialties"> Other Specialties </option>
              <option value="drinks"> Drinks </option>
          </select>
          </br>
          @error('category')
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
          <label for="image">Food image</label></br>
          <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg" value ={{old('image')}}></br>
          <input type="submit" value="Save" class="btn btn-success mt-2"></br>
      </form>
      
    </div>
  </div>

@endsection