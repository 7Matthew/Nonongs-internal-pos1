@extends('staff.layouts.staff-layout')

@section('topnav-items')
    <div class="row">
        <div class="col">
            <div class="col mt-2" data-aos="fade-in"  data-aos-delay="200" data-aos-duration="500" data-aos-easing="ease-in-out">
                <nav class = "navbar-nav" id="categs">
                    <li class="nav-item justify-content-end">
                        @php
                            $categories = \App\Models\Category::get()->where('label', '==','ingredients');
                            $data = \App\Models\Item::get()->all();
                            $suppliers = \App\Models\Supplier::get()->all();
                        @endphp        
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
        <script>
            $(document).ready( function () {
                $('#order_history').DataTable({
                    order: [[0,'desc']],
                });
            });
        </script>
        <div class="col p-5 m-relative"> 
            <table id="order_history" class="table table-striped aos-init aos-animate" data-aos="fade-right" data-aos-delay="500" data-aos-duration="700">
                <thead>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Created by</th>
                    <th>Cost</th>
                    <th>Stock</th>
                    <th>Expiry</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <img src="{{$item->image ? asset('storage/'. $item->image) : asset('images/logo.jpg') }}" class="mb-2 elevation-1" title="{{$item->name}}"alt="item" width="10%" height="10%"> {{$item->name}}
                        </td>
                        <td>{{$item->quantity . ' ' . $item->measuring_unit}}</td>
                        <td>{{$item->supplier->name}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->cost}}</td>
                        <td>{{$item->stocks}}</td>
                        <td>{{$item->expiry_date}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm mt-2" title="View Item" data-bs-toggle="modal" data-bs-target="{{"#modal-show-food-item".$item->id}}"><i class="fa-solid fa-eye"></i></button>
                            <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target={{"#modal-edit-food-item".$item->id}} title="Edit Item"><i class="fa-regular fa-pen-to-square"></i></button>

                            <form method="POST" action="{{ route('inventory.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL Create --}}

<div class="modal fade" id="modal-create-food-item" tabindex="-1" aria-labelledby="modal-create-food-item" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-alert bg-warning">
                <h1 class="modal-title fs-4" id="modal-confirm-order">Create Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <label for="name">Name</label></br>
                            <input type="text" name="name" id="name" class="form-control" value ="{{old('name')}}"></br>
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <label for="quantity">quantity</label></br>
                            <input type="number" name="quantity" id="quantity" placeholder="0.00" class="form-control" value ="{{old('quantity')}}"></br>
                            @error('quantity')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <label for="measuring_unit">Measurement</label></br>
                            
                            <select name="measuring_unit" id="measuring_unit" class="form-select" value="{{old('measuring_unit')}}">
                                <option value=""></option>
                                <option value="L">Liter</option>
                                <option value="Oz">Ounce</option>
                                <option value="g">grams</option>
                                <option value="Kg">Kilograms</option>
                                <option value="Pcs">Pieces</option>
                                <option value="Pack">Pack</option>
                                <option value="Bundle">Bundle</option>
                            </select>
                            @error('measuring_unit')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <label for="supplier_id" class="form-label">Supplier</label></br>
                            <select name ="supplier_id" id="supplier_id" class="form-control" value ="{{old('supplier_id')}}">
                                <option></option>
                                @foreach ($suppliers as $supplier)
                                    <option value={{$supplier->id}}>{{$supplier->name}}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <label for="category" class="form-label">Category</label></br>
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
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <label for="cost">Cost</label></br>
                            <input type="number" name="cost" id="cost" class="form-control" value ="{{old('cost')}}"></br>
                            @error('cost')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="stocks">Stocks</label></br>
                            <input type="number" name="stocks" id="stocks" class="form-control" value ="{{old('stocks')}}"></br>
                            @error('stocks')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="expiry_date">Expiry</label></br>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control" value ="{{old('expiry_date')}}"></br>
                            @error('expiry_date')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    
                    <label for="image">Food image</label></br>
                    <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg" value ={{old('image')}}></br>
                    <button type="submit" class="btn btn-success mt-2"> Submit </button></br>
                </form>
            </div>
        </div>
    </div>
</div>  

{{-- create new category --}}
<div class="modal fade" id="modal-create-new-category" tabindex="-1" aria-labelledby="modal-create-food-item" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-alert bg-warning">
                <h1 class="modal-title fs-4" id="modal-confirm-order">Create New Category</h1>
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
                    <label for="label">Label</label></br>
                    <input type="text" name="label" id="label" class="form-control" value ="{{old('label')}}"></br>
                    @error('label')
                      <div class="alert alert-danger" role="alert">
                        <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                      </div>
                    @enderror
                    <button type="submit" class="btn btn-success mt-2">Submit</button></br>
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
                    <h1 class="modal-title fs-4" id="modal-confirm-order">Edit {{$item->name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('inventory.update', ['inventory'=> $item->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label>Name</label></br>
                        <input type="text" name="name" id="name" class="form-control" value ="{{$item->name}}"></br>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror
                        <label for="supplier_id" class="form-label">Supplier</label></br>
                        <select name ="supplier_id" id="supplier_id" class="form-control">
                            <option></option>
                            <option value={{$item->supplier_id}} selected>{{$item->supplier->name}}</option>
                            @foreach ($suppliers as $supplier)
                                <option value={{$supplier->id}}>{{$supplier->name}}</option>
                            @endforeach
                        </select>
                        </br>
                        @error('supplier_id')
                        <div class="alert alert-danger" role="alert">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                        </div>
                        @enderror   
                        <label for="category" class="form-label">Category</label></br>
                        <select name ="category_id" id="category" class="form-control" value ="{{old('category_id')}}">
                            <option></option>
                            <option value={{$item->category_id}} selected>{{$item->category->name}}</option>
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
                        <label>Cost</label></br>
                        <input type="number" name="cost" id="cost" class="form-control" value ="{{$item->cost}}"></br>
                        @error('cost')
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
                        <button type="submit" class="btn btn-success">Submit</button>
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
                            Supplier: {{$item->supplier->name}}
                        </h4>
                        <h4>
                            Cost: {{$item->cost}}
                        </h4>
                        <h4>
                            Stocks: {{$item->stocks}}
                        </h4>
                        <h4>
                            Created by: {{$item->user->name}}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
