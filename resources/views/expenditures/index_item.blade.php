@extends('layouts.guest')

@section('content')
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <h1 class="text-center fw-bold mb-4 text-2xl">Items List</h1>

     <!-- Display the success message if it exists -->
     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <p>No Items found.</p>
    @else

    <!-- Table Container -->
    <!-- <div class="overflow-x-auto px-4"> -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through each item -->
                @php $counter = 1; @endphp
                @foreach ($items as $item)
                    <tr>
                        <td>{{ sprintf('%d', $counter++) }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>
                            <!-- Link to Expenditure for this specific item -->
                            <a href="{{ route('expenditures.show', ['item_id' => $item->id]) }}"
                                class="btn btn-info btn-sm">View Expenditure</a>
                            |
                            <!-- Link to Add Expenditure for this specific item -->
                            <a href="{{ route('expenditures.create', ['item_id' => $item->id]) }}"
                                class="btn btn-primary btn-sm">Add Expenditure</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <!-- </div> -->
    @endif
@endsection
