<!-- resources/views/admin/item_groups/edit.blade.php -->
@extends('layouts.admin')

@section('content')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <h1 class="text-center fw-bold mb-4">Edit Item Group</h1>

    <!-- Form to edit an existing Item Group -->
    <div class="d-flex justify-content-center">
        <form action="{{ route('item-groups.update', $itemGroup) }}" method="POST" class="w-50 p-4 border rounded shadow-sm bg-light">
            @csrf
            @method('PUT')
            
            <!-- Input field for Item Group Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Item Group Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $itemGroup->name }}" required placeholder="Enter new name for item group">
            </div>

            <!-- Submit and Cancel buttons -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('item-groups.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>

@endsection
