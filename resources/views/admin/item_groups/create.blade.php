@extends('layouts.admin')

@section('content')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <h1 class="text-center fw-bold mb-4">Create Item Group</h1>

    <!-- Display the success message if it exists -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <!-- Form to create a new Item Group -->
    <div class="d-flex justify-content-center">
        <form action="{{ route('item-groups.store') }}" method="POST" class="w-50 p-4 border rounded shadow-sm bg-light">
            @csrf
            <!-- Input field for Item Group Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Item Group Name</label>
                <input type="text" name="name" id="name" class="form-control" required placeholder="Enter item group name">
            </div>

            <!-- Submit button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('item-groups.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
