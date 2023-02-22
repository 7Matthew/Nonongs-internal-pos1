@extends('admin.layouts.admin-layout')

@section('title','Dashboard')
@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <script>
            $(document).ready( function () {
                $('#user_table').DataTable({
                    responsive: true,
                    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
                    "scrollY": "50vh",
                    "scrollCollapse": true,
                    "paging": true
                });
            });
        </script>
        <div class="col m-relative">
            <div class="card">
                <div class="card-header">
                    <span class="card-text">
                        <h6>Manage Users</h6>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col">
                            <button type="button" class="col-lg-2 btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modal-add-user"><i class="fa-solid fa-square-plus fa-lg mr-3"></i>Add new user</button>
                        </div>
                    </div>
                    
                    <table class="table table-striped mt-2 table-hover" id="user_table">
                        <thead>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>    
                                <td><i class="fa-solid fa-user mr-3 text-primary"></i>{{ucwords($item->name)}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if($item->role == 0)
                                        <b class="text-success">Admin</b>
                                    @else
                                        <b class="text-danger">Staff</b>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" title="Edit user {{$item->name}}" data-bs-toggle="modal" data-bs-target="#modal-edit-user{{$item->id}}"><i class="fa-regular fa-pen-to-square"></i></button>
                                    
                                    <form method="POST" action="{{ route('manage-users.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" title="Delete user {{$item->name}}" data-bs-toggle="modal" data-bs-target="#modal-delete-user{{$item->id}}"><i class="fa-solid fa-trash"></i></button>
                                        <div class="modal fade" id="modal-delete-user{{$item->id}}" tabindex="-1" aria-labelledby="modal-delete-user" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex pb-5">
                                                <h1 class="modal-title fs-5" id="modal-confirm-order">Confirm Deletion of {{ $item->name }}?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success">Confirm</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>      
                            </tr>
                            @include('modals.modals')
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
