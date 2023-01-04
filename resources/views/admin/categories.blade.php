@extends('admin.layouts.admin-layout')

@section('title','Categories')
@section('content')
<div class="container-fluid mt-5">
    <script>
        $(document).ready( function () {
            $('#category_table').DataTable();
        });
    </script>
    <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card p-5">
                <div class="row mb-2">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button class="btn btn-success btn-sm" title="Add Menu" data-bs-toggle="modal" data-bs-target="#modal-create-new-category">
                                <i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new Category
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="category_table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Label</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->label}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" title="Edit {{$category->name}}" data-bs-toggle="modal" data-bs-target="#modal-edit-category{{$category->id}}"><i class="fa-regular fa-pen-to-square"></i></button>
                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}" accept-charset="UTF-8" style="display:inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" title="Delete item" data-bs-toggle="modal" data-bs-target={{"#modal-delete-food-item".$category->id}}><i class="fa-solid fa-trash"></i></button>
                                        <div class="modal fade" id={{"modal-delete-food-item".$category->id}} tabindex="-1" aria-labelledby="modal-confirm-order" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content">
                                                <div class="modal-header d-flex pb-5">
                                                  <h1 class="modal-title fs-5" id="modal-confirm-order">Confirm Deletion of {{ $category->name }}?</h1>
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
        <div class="col-lg-4">

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
                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
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
                        <input type="submit" value="Save" class="btn btn-success mt-2"></br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- edit category --}}
    @foreach ($categories as $item)
        <div class="modal fade" id={{"modal-edit-category".$item->id}} tabindex="-1" aria-labelledby="modal-edit-food-item" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-alert bg-warning">
                        <h1 class="modal-title fs-4" id="modal-confirm-order">Edit Food Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('categories.update', ['category'=> $item->id])}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                                @csrf
                                @method('PUT')
                                <label>Name</label></br>
                                <input type="text" name="name" id="name" class="form-control" value ="{{$item->name}}"></br>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                                </div>
                                @enderror
                                <label for="label" class="form-label">Label</label></br>
                                <input type="text" name="label" id="label" class="form-control" value ="{{$item->label}}"></br>
                                @error('label')
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa-solid fa-circle-exclamation"></i>{{ucwords($message)}}
                                </div>
                                @enderror
                        </div>
                        <div class="modal-footer">
                            <input type="submit" value="Save" class="btn btn-success"> 
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
</div>
@endsection
