@extends('layouts.layout')

@section('content')

    @foreach($guitars as $item)
    <div class="row mt-3 text-center"> 
        <h3><a class="text-dark" href="{{ route('guitars.show',['guitar' => $item['id']])}}">{{$item['name']}}</a></h3>
        <ul>
            <li>Made by:{{$item['brand']}}</li>
            <li>{{$item['year_made']}}</li>
        </ul>
    </div>
    @endforeach
@endsection