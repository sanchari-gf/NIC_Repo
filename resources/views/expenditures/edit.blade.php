@extends('layouts.guest')

@section('content')
    <h1 class="text-center fw-bold mb-4">Edit Expenditure</h1>

     <!-- Display the success message if it exists -->
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <form action="{{ route('expenditures.update', ['expenditure' => $expenditure->id]) }}" method="POST" class="w-50 p-4 border rounded shadow-sm bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="amount" class="form-label fw-bold">Amount</label>
                <input type="text" name="amount" id="amount" class="form-control" value="{{ $expenditure->amount }}" required>
            </div>

            <div class="mb-3">
                <label for="item_id" class="form-label fw-bold">Item</label>
                <select name="item_id" id="item_id" class="form-control" required>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ $expenditure->item_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary me-2">Update Expenditure</button>
                <a href="{{ route('guest.items.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
