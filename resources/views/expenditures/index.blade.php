@extends('layouts.guest')

@section('content')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <h1 class="text-center fw-bold mb-4 text-2xl">Your Expenditures</h1>

    <!-- Button to redirect to index_item page -->

    <div class="mb-3">
        <a href="{{ route('guest.items.index') }}" class="btn btn-secondary">Back to Items List</a>
    </div>

     <!-- Display the success message if it exists -->
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($expenditures->isEmpty())
        <p>No expenditures found for this item.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Item Name</th>
                    <th>Expenditure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp
                @foreach ($expenditures as $expenditure)
                    <tr>
                        <td>{{ sprintf('%d', $counter++) }}</td>
                        <td>{{ $expenditure->item->name }}</td>
                        <td>{{ $expenditure->amount }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('expenditures.edit', ['expenditure' => $expenditure->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            |
                            <!-- Delete Button -->
                            <form action="{{ route('expenditures.destroy', ['expenditure' => $expenditure->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Display Total Expenditure Below the Table -->
        <div class="text-center fw-bold mb-3 text-2xl">
            <h4>Total Expenditure: {{ number_format($totalExpenditure, 2) }}</h4>
        </div>
    @endif
@endsection
