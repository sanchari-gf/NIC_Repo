<!-- resources/views/expenditures/create.blade.php -->


@extends('layouts.guest')

@section('content')
   
        <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])
     
     
<h1 class="text-center fw-bold mb-4 text-2xl">Create Expenditure for Item: {{ $item->name }}</h1>

 <!-- Display the success message if it exists -->
 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<div class="d-flex justify-content-center">
    <form action="{{ route('expenditures.store', $item->id) }}" method="POST" class="w-50 p-4 border rounded shadow-sm bg-light">
        @csrf

        <!-- Item Name -->
        <div class="mb-3">
        <label for="amount" class="form-label fw-bold">Amount:</label>
        <input type="text" name="amount" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Add Expenditure</button>
        <a href="{{ route('guest.items.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

    @endsection
