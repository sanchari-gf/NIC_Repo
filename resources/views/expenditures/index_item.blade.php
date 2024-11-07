 <!-- Add Logout Form -->
 <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Logout</button>
</form>
<h1>Items List</h1>

<ul>
@foreach ($items as $item)
    <li>
        {{ $item->name }} - {{ $item->price }}
        
        <!-- Link to Expenditure for this specific item -->
        <a href="{{ route('expenditures.show', ['item_id' => $item->id]) }}">View Expenditure</a>

        <a href="{{ route('expenditures.create', ['item_id' => $item->id]) }}">Add Expenditure</a>
    </li>
@endforeach

</ul>
