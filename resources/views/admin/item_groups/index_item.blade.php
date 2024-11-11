@extends('layouts.admin')

@section('content')
    <h2 class="text-center fw-bold">Items</h2>

    <div class="mb-3">
        <a href="{{ route('item-groups.index') }}" class="btn btn-secondary">Back to Item Groups</a>
    </div>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <p>No items found for this group.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Item Group Name</th>
                    <th>Price</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

            @php $counter = 1; @endphp
                @foreach($items as $item)
                    <tr>
                        <td>{{ sprintf('%d', $counter++) }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $itemGroup->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
