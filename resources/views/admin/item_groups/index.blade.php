@extends('layouts.admin')

@section('content')
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <h1 class="login-title fw-bold">Item Groups</h1> <!-- Centering the title using text-center class -->

    <!-- Display the success message if it exists -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

  
    <!-- Aligning the "Create Item Group" button to the right -->
    <div class="text-end text-center mb-3">
        <a href="{{ route('item-groups.create') }}" class="btn btn-primary">Create Item Group</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('dashboard_admin') }}" class="btn btn-secondary">Back to Dashboard</a>
        
    </div>
    <h4 class="login-title fw-bold">Item Groups List</h4> <!-- Centering the title using text-center class -->
    

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
                    <th>View Item</th>
                </tr>
            </thead>
            <tbody>
            @php $counter = 1; @endphp
            @foreach($itemGroups as $itemGroup)
                <tr>
                    <td>{{ sprintf('%d', $counter++) }}</td>
                    <td>{{ $itemGroup->name }}</td>
                    <td>
                        <a href="{{ route('item-groups.edit', $itemGroup->id) }}" class="btn btn-primary btn-sm" aria-label="Edit item group">Edit</a>
                        <form action="{{ route('item-groups.destroy', $itemGroup) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" aria-label="Delete item group">Delete</button>
                        </form>
                    </td>
                    <td>
                        <!-- Add the "Add Item" button that links to the create item page for this item group -->
                        <a href="{{ route('items.create', ['item_group_id' => $itemGroup->id]) }}" class="btn btn-primary btn-sm">Add Item</a>
                    </td>

                    <td>
                        <!-- Add the "Add Item" button that links to the create item page for this item group -->
                        <a href="{{ route('items.index', ['item_group_id' => $itemGroup->id]) }}" class="btn btn-info btn-sm">View Item</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
