@extends('layouts.admin')

@section('content')
    <h1>Item Groups</h1>
    <a href="{{ route('item-groups.create') }}" class="btn btn-primary mb-3">Create Item Group</a>

    @if($itemGroups->isEmpty())
        <p>No item groups found.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                    <th>Add Item</th> <!-- Add this column for the 'Add Item' button -->
                </tr>
            </thead>
            <tbody>
            @php $counter = 1; @endphp
            @foreach($itemGroups as $itemGroup)
                <tr>
                    <td>{{ sprintf('%d', $counter++) }}</td>
                    <td>{{ $itemGroup->name }}</td>
                    <td>
                        <a href="{{ route('item-groups.edit', $itemGroup->id) }}" class="btn btn-warning btn-sm" aria-label="Edit item group">Edit</a>
                        <form action="{{ route('item-groups.destroy', $itemGroup) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" aria-label="Delete item group">Delete</button>
                        </form>
                    </td>
                    <td>
                        <!-- Add the "Add Item" button that links to the create item page for this item group -->
                        <a href="{{ route('items.create', ['item_group_id' => $itemGroup->id]) }}" class="btn btn-success btn-sm">Add Item</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
