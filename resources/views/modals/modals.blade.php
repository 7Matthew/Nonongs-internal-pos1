{{-- MODAL CREATE NEW USER --}}
<div class="modal fade" id="modal-add-user" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modal-add-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-alert bg-warning">
                <h1 class="modal-title fs-4" id="modal-confirm-order">Add New User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ 'Field is required!' }}</strong>
                </span>
            @enderror
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ 'Field is required!' }}</strong>
                </span>
            @enderror
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ 'Field is required!' }}</strong>
                </span>
            @enderror
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ 'Field is required!' }}</strong>
                </span>
            @enderror
            <form method="POST" action="{{ route('manage-users.store') }}">
                <div class="modal-body">
                        @csrf
                        <div class="row mb-2">
                            <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-md-end text-center form-text text-danger">Required field *</span>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-label text-md-end">
                                {{ __('Name') }} <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Email Address') }} <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="sample@gmail.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">
                                {{ __('Username') }} <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">
                                {{ __('Role') }} <span class="text-danger">*</span>
                            </label>
                            <select id="role" name="role" class="col-md-6 form">
                                <option value="0">Admin</option>
                                <option value="1">Staff</option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                {{ __('Password') }} <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="atleast 8 characters"> 
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                                {{ __('Confirm Password') }} <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="atleast 8 characters">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"> {{ __('Register') }} </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT USER --}}
<div class="modal fade" id="modal-edit-user{{$item->id}}" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modal-edit-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-alert bg-warning">
                <h1 class="modal-title fs-4" id="modal-confirm-order">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <form method="POST" class="mt-4" action="{{ route('manage-users.update', ['manage_user'=> $item->id]) }}" enctype="multipart/form-data">
                <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <span class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-md-end text-center form-text text-danger">Required field *</span>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                {{ __('Name') }} <span class="text-danger">*</span>
                            </label>
        
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Email Address') }} <span class="text-danger">*</span>
                            </label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $item->email }}" required autocomplete="email">
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">
                                {{ __('Username') }} <span class="text-danger">*</span>
                            </label>
        
                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $item->username }}" required autocomplete="username">
                            </div>
                        </div>
        
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">
                                {{ __('Role') }} <span class="text-danger">*</span>
                            </label>
                            <select id="role" name="role" class="col-md-6 form">
                                @if ($item->role == 0)
                                    <option value="0">Admin</option>
                                    <option value="1">Staff</option>
                                @elseif($item->role == 1)
                                    <option value="1">Staff</option>
                                    <option value="0">Admin</option>
                                @endif
                            </select>
                        </div>
        
                </div>
                <div class="modal-footer">
                    <a  href="{{route('manage-users.index')}}"><button type="button" class="btn btn-primary">Cancel</button></a>
                    <button type="submit" class="btn btn-success"> {{ __('Submit') }}  </button>
                </div>
            </form>
        </div>
    </div>
</div>

