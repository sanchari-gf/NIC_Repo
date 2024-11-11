@extends('layouts.admin')

@section('content')

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <h1 class="text-center fw-bold mb-4">Create Item for Group: {{ $itemGroup ? $itemGroup->name : 'Unknown Group' }}</h1>

  <div class="d-flex justify-content-center">
    <form action="{{ route('items.store', $itemGroup->id) }}" method="POST" class="w-50 p-4 border rounded shadow-sm bg-light">
        @csrf
        <!-- Item Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Item Name:</label>
            <input type="text" name="name" required class="form-control">
        </div>

        <!-- Item Price -->
        <div class="mb-3">
            <label for="price" class="form-label fw-bold">Price:</label>
            <input type="number" step="0.01" name="price" required class="form-control">
        </div>

        <!-- Hidden Field for item_group_id -->
        <input type="hidden" name="item_group_id" value="{{ $itemGroup->id }}">

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Create Item</button>
        <a href="{{ route('item-groups.index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </div>
    </form>
  </div>

@endsection
