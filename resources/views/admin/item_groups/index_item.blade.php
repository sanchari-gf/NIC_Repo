@extends('layouts.admin')
@section('content')
    <h1>Items List</h1>




    <ul>
        @foreach ($items as $item)
            <li>{{ $item->name }} - {{ $item->price }}</li>
        @endforeach
    </ul>
    @endsection