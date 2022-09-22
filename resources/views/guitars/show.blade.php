@extends('layouts.layout')

@section('content')

    <div class="row mt-3 text-center"> 
        <h3>{{$guitar['name']}}</h3>
        <ul>
            <li>Made by:{{$guitar['brand']}}</li>
            <li>{{$guitar['year_made']}}</li>
            <a class="btn btn-primary" href="{{route('guitars.edit', $guitar->id)}}">EDIT</a>
        </ul>
    </div>
@endsection