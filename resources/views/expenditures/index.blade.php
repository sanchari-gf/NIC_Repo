<!-- resources/views/expenditures/index.blade.php -->
 <!-- Add Logout Form -->
 <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Logout</button>
</form>

    <h1>Your Expenditures</h1>

    <ul>
        @foreach ($expenditures as $expenditure)
            <li>{{ $expenditure->item->name }} - {{ $expenditure->amount }} </li>
        @endforeach
    </ul>

