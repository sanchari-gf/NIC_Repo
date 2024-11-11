@extends('layouts.admin')

@section('content')
    <h2 class="text-center fw-bold mb-4">Edit Item</h2>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="d-flex justify-content-center">
    <!-- Edit Item Form -->
    <form action="{{ route('items.update', $item->id) }}" method="POST" class="w-50 p-4 border rounded shadow-sm bg-light">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Item Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label fw-bold">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" class="form-control" required>
        </div>

        <!-- Submit button -->
        <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('items.index', ['item_group_id' => $item->item_group_id]) }}" class="btn btn-secondary ms-2">Back to Items</a>
        </div>
    </form>
</div>
@endsection
