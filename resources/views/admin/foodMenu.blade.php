@extends('admin.layouts.admin-layout')

@section('topnav-items')
    <div class="row">
        <div class="col">
            <div class="col mt-2" data-aos="fade-in"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <nav class = "navbar-nav" id="categs">
                    <li class="nav-item justify-content-end">
                        @php
                            $categories = \App\Models\Category::where('label', '!=', 'ingredients')->get();
                        @endphp        
                        @foreach ($categories as $category)
                            <a href={{"#".$category->name}}> {{$category->name}} </a>
                        @endforeach
                    </li>
                </nav> 
            </div>
        </div>
    </div>  
@endsection

@section('title','Food Menu')
@section('content')



<div class="container-fluid mt-5" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#categs">
    @if(Session::has('success'))
    <div class="toast-show alert alert-success text-dark mt-4 p-auto" data-aos="fade-in" delay="500" duration="700" data-bs-dismiss="alert" aria-label="Close" role="alert">
        {{ 'Item Added Successfully!' }}
    </div>
    @endif
    @if(Session::has('edit-success'))
        <div class="alert alert-success text-dark mt-4 p-auto " data-aos="fade-in" delay="500" duration="700" data-bs-dismiss="alert" aria-label="Close" role="alert">
            {{ 'Item Edited Successfully!' }}
        </div>
    @endif
    @if(Session::has('delete-success'))
        <div class="alert alert-success text-dark mt-4 p-auto " data-aos="fade-in" delay="500" duration="700" data-bs-dismiss="alert" aria-label="Close" role="alert">
            {{ 'Item Deleted Successfully!' }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-4 col-md-8 col-sm-12">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <button class="btn btn-success btn-sm ml-5" title="Add Menu" data-bs-toggle="modal" data-bs-target="#modal-create-food-item">
                    <i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new Item
                </button>
                <button class="btn btn-warning btn-sm" title="Add Menu" data-bs-toggle="modal" data-bs-target="#modal-create-new-category">
                    <i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new Category
                </button>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col p-5 m-relative"> 
            @foreach ($categories as $category)
            <div class="card border-3 mt-2" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out" id={{$category->name}}>
                <div class="card-header text-gray bg-danger">
                    <h6> {{$category->name}} </h6>
                </div>
                <div class="card-body text-dark">
                    <div class="row">
                        @foreach ($data as $item)
                            @if($item->category_id == $category->id)
                                <div class="col-lg-2 col-md-4 col-sm-6" >
                                    <div class="card no-border m-relative p-auto">
                                        <div class="page-content justify-content">
                                            <img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="50%" height="50%">
                                            <p class ="justify-content d-flex"font size ="2px">{{$item->name}}</p>
                                            
                                            <button type="button" class="btn btn-info btn-sm mt-2" title="View Item" data-bs-toggle="modal" data-bs-target="{{"#modal-show-food-item".$item->id}}"><i class="fa-solid fa-eye"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target={{"#modal-edit-food-item".$item->id}} title="Edit Item"><i class="fa-regular fa-pen-to-square"></i></button>

                                            <form method="POST" action="{{ route('food-item.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm mt-2" title="Delete item" data-bs-toggle="modal" data-bs-target={{"#modal-delete-food-item".$item->id}}><i class="fa-solid fa-trash"></i></button>
                                                <div class="modal fade" id={{"modal-delete-food-item".$item->id}} tabindex="-1" aria-labelledby="modal-confirm-order" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                        <div class="modal-header d-flex pb-5">
                                                          <h1 class="modal-title fs-5" id="modal-confirm-order">Confirm Deletion of {{ $item->name }}?</h1>
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
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- MODAL Create --}}

<div class="modal fade" id="modal-create-food-item" tabindex="-1" aria-labelledby="modal-create-food-item" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-alert bg-warning">
                <h1 class="modal-title fs-4" id="modal-confirm-order">Create Food Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('food-item.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Name</label></br>
                    <input type="text" name="name" id="name" class="form-control" value ="{{old('name')}}"></br>
                    @error('name')
                      <div class="alert alert-danger" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                      </div>
                    @enderror
                    <label for="category" class="form-label">Category</label></br>
                    <select name ="category_id" id="category" class="form-control" value ="{{old('category_id')}}">
                        <option></option>
                        @foreach ($categories as $category)
                            <option value={{$category->id}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    </br>
                    @error('category')
                      <div class="alert alert-danger" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                      </div>
                    @enderror
                    <label for="description" class="form-label">Description</label></br>
                    <input type="text" name="description" id="description" class="form-control" value ="{{old('description')}}"></br>
                    @error('description')
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
    </div>
</div>  


{{-- MODAL Edit and show --}}
@foreach ($data as $item)
    <div class="modal fade" id={{"modal-edit-food-item".$item->id}} tabindex="-1" aria-labelledby="modal-edit-food-item" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-alert bg-warning">
                    <h1 class="modal-title fs-4" id="modal-confirm-order">Edit Food Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('food-item.update', ['food_item'=> $item->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label>Name</label></br>
                        <input type="text" name="name" id="name" class="form-control" value ="{{$item->name}}"></br>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label for="description" class="form-label">Description</label></br>
                        <input type="text" name="description" id="description" class="form-control" value ="{{$item->description}}"></br>
                        @error('description')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label>Price</label></br>
                        <input type="number" name="price" id="price" class="form-control" value ="{{$item->price}}"></br>
                        @error('price')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label>Stocks</label></br>
                        <input type="number" name="stocks" id="stocks" class="form-control" value ="{{$item->stocks}}"></br>
                        @error('stocks')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label for="image">Food image</label></br>
                        <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg" value ={{$item['image']}}></br>
                        <input type="submit" value="Save" class="btn btn-success"> 
                        <a href="{{ route('food-item.index') }}" class="btn btn-primary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id={{"modal-show-food-item".$item->id}} tabindex="-1" aria-labelledby="modal-show-food-item" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-alert bg-warning">
                    <h1 class="modal-title fs-4" id="modal-confirm-order">View Food Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="page-content justify-content">
                        <h3 class="bg-danger p-2 rounded">
                            <img src={{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }} alt={{$item->name}} width="10%" height="10%">
                            {{$item->name}}
                        </h3>
                        <h4>
                            ID: {{$item->id}}
                        </h4>
                        <h4>
                            Description: {{ $item->description }}
                        </h4>
                        <h4>
                            Price: {{$item->price}}
                        </h4>
                        <h4>
                            Stocks: {{$item->stocks}}
                        </h4>
                        <h4>
                            Created by: {{\App\Models\FoodItem::find($item->id)->user->name}}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach



@endsection
