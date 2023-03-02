@extends('admin.layouts.admin-layout')

@section('topnav-items')
    <div class="row">
        <div class="col">
            <div class="col mt-2" data-aos="fade-in"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <nav class = "navbar-nav" id="categs">
                    <li class="nav-item justify-content-end">
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            @php
                                $categories = \App\Models\Category::where('label', '!=', 'ingredients')->get();
                                $ingredients = \App\Models\Item::where('expiry_date', '>', date('Y-m-d'))->get();
                            @endphp        
                            @foreach ($categories as $category)
                                <button type="button" class="btn btn-transapernt btn-sm border border-1 m-2"><a href={{"#".$category->name}}> {{$category->name}}</a></button>
                            @endforeach
                        </div>
                    </li>
                </nav> 
            </div>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>  
@endsection

@section('title','Food Menu')
@section('content')


<script type="text/javascript">
    
    $(document).ready(function(){
        //Get the button
        let mybutton = document.getElementById("scrollToTop");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20)
            {
                $("#scrollToTop").show(200);
            } 
            else 
            {
                $("#scrollToTop").hide(200);
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        $("#scrollToTop").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "fast");
            return false;
        });
    }) 
</script>

<div class="container-fluid mt-5" data-bs-smooth-scroll="true" data-bs-spy="scroll" data-bs-target="#categs">

    {{-- SCROLL TO TOP --}}
    <button class="btn btn-success btn-md" type="button" id="scrollToTop">
        <i class="fa-solid fa-arrow-up fa-lg"></i>  
    </button>

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
            <button class="btn btn-success btn-sm" title="Add item" data-bs-toggle="modal" data-bs-target="#modal-create-food-item">
                <i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new Item
            </button>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col m-relative"> 
                @foreach ($categories as $category)
                    <div class="card mt-2" data-aos="fade-left" data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out" id={{$category->name}}>
                        <div class="card-header bg-gradient-danger text-light no-border">
                            <h6> {{$category->name}} </h6>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                @foreach ($data as $item)
                                    @if($item->category_id == $category->id)
                                        <section class="col-lg-2 col-md-4 col-sm-12 col-xs-12" >
                                            <div class="card no-border m-relative p-auto">
                                                <div class="page-content justify-content">
                                                    <img src="{{$item->image ? asset('uploads/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}" alt="item" width="50%" height="50%">
                                                    <section class="overflow-hidden" style="height:50px;">
                                                        <p class="text-left" font size ="2px">{{$item->name . ' '. $item->description}}</p>
                                                    </section>
                                                    {{-- ACTION BUTTONS --}}
                                        
                                                    <button type="button" class="btn btn-info btn-sm mt-2" title="View Item" data-bs-toggle="modal" data-bs-target="{{"#modal-show-food-item".$item->id}}"><i class="fa-solid fa-eye"></i></button>
                                                    <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target={{"#modal-edit-food-item".$item->id}} title="Edit Item"><i class="fa-regular fa-pen-to-square"></i></button>
                                                    <button type="button" class="btn btn-warning btn-sm mt-2" title="Add ingredients"><i class="fa-solid fa-kitchen-set" data-bs-toggle="modal" data-bs-target="{{"#modal-add-ingredients" . $item->id}}"></i></button>
    
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
                                        </section>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
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
                    <div class="row mb-2">
                        <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-text text-danger">Required field *</span>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label></br> 
                            <input type="text" name="name" id="name" class="form-control" value ="{{old('name')}}"></br>
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="form-label" for="category" class="form-label">Category <span class="text-danger">*</span> </label></br>
                            <select name ="category_id" id="category" class="form-control" value ="{{old('category_id')}}">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value={{$category->id}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="form-label" for="description" class="form-label">Description <span class="text-danger">*</span> </label></br>
                            <input type="text" name="description" id="description" class="form-control" value ="{{old('description')}}"></br>
                            @error('description')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-3 col-sm-12 col-xs-12">
                            <label class="form-label" for="price">Price <span class="text-danger">*</span> </label></br>
                            <input type="number" name="price" id="price" class="form-control" value ="{{old('price')}}"></br>
                            @error('price')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    
                    <label class="form-label" for="image">Food image</label></br>
                    <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg" value ={{old('image')}}></br>
                    <input type="submit" value="Save" class="btn btn-success mt-2"></br>
                </form>
            </div>
        </div>
    </div>
</div>  




@foreach ($data as $item)
    
    {{-- Modal Add Ingredients --}}
    <div class="modal fade" id="{{"modal-add-ingredients" . $item->id}}" tabindex="-1" aria-labelledby="modal-add-ingredients" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-alert bg-warning">
                    <h1 class="modal-title fs-4" id="modal-confirm-order">Add ingredients for {{$item->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('foodItem_ingredients.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2" id="ingredients">
                            <div class="col-lg-4">
                                <label class="form-label" for="item">Ingredients</label></br>
                                <select name ="item_id" id="item_id" class="form-select" value ="{{old('item_id')}}">
                                    <option>--Select Ingredient--</option>
                                    @foreach ($ingredients as $ingredient)
                                        <option value={{$ingredient->id}}>{{$ingredient->name . " in $ingredient->measuring_unit"}}</option>
                                    @endforeach
                                </select>    
                                 {{--error condition  --}}
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label" for="quantity">Quantity</label></br>
                                <input type="number" class="form-control" name="quantity" id="quantity" value="{{old('quantity')}}" step=".01">  
                                {{-- Error condition --}}
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label" for="food_item_id">Food ID</label></br>
                                <input type="number" class="form-control" name="food_item_id" id="food_item_id" value="{{$item->id}}" readonly>  
                                {{-- Error condition --}}
                            </div>
                        </div>
                        {{-- submit --}}
                        <input type="submit" value="Save" class="btn btn-success mt-2"></br>
                    </form>
                </div>
            </div>
        </div>
    </div>  

    {{-- MODAL Edit and show --}}
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
                        <div class="row mb-2">
                            <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-text text-danger">Required field *</span>
                        </div>
                        <label for="name" class="form-label"> Name <span class="text-danger">*</span> </label></br>
                        <input type="text" name="name" id="name" class="form-control" value ="{{$item->name}}"></br>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label class="form-label" for="description">Description </label></br>
                        <input type="text" name="description" id="description" class="form-control" value ="{{$item->description}}"></br>
                        @error('description')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label>Price <span class="text-danger">*</span> </label></br>
                        <input type="number" name="price" id="price" class="form-control" value ="{{$item->price}}"></br>
                        @error('price')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        

                        <label class="form-label" for="image">Food image</label></br>
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
                            Ingredients:
                            @php
                                $ingredient = \App\Models\FoodItem::find($item->id);
                            @endphp
                            @foreach ($ingredient->item as $data)
                                {{$data->name . ", "}}
                            @endforeach
                        </h4>
                        <h4>
                            Price: {{$item->price}}
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
