@extends('layouts.layout')

@section('content')

<div class="row">
    <div class="col m-relative mt-5">
        <div class="card ml-5 mr-5" style="margin-left:25%;width:55%;">
            <div class="card-header">
                Add Guitar
            </div>
            <div class="card-body text-dark">
                <form  class="form bg-white p-5"  action="{{route('guitars.store')}}" method = "POST">
                    @csrf
                    <div>
                        <label for="name" class="text-sm">Guitar name</label>
                        <input type="text" class="form-control text-lg border-1 mb-2" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{'Required Field!'}}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="brand" class="text-sm">Guitar brand</label>
                        <input type="text" class="form-control text-lg border-1 mb-2" id="brand" name="brand"  value="{{ old('brand') }}">
                        @error('brand')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{$message}}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="year_made" class="text-sm">year_made</label>
                        <input type="text" class=" form-control text-lg border-1 mb-2" id="year_made" name="year_made"  value="{{ old('year_made') }}">
                        @error('year_made')
                            <div class="alert alert-danger" role="alert">
                                <i class="fa-solid fa-circle-exclamation"></i>{{$message}}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button class = "btn btn-success border-1 mt-4" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection