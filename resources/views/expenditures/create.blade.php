<!-- resources/views/expenditures/create.blade.php -->

     <!-- Add Logout Form -->
     <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Logout</button>
</form>
<h1>Add Expenditure for {{ $item->name }}</h1>

    <form action="{{ route('expenditures.store', $item->id) }}" method="POST">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" name="amount" required>
        <button type="submit">Add Expenditure</button>
    </form>

