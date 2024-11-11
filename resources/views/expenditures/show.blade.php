 <!-- Add Logout Form -->
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
 <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Logout</button>
</form>

<h1>Expenditures for {{ $item->name }}</h1>

<ul>
    @foreach ($expenditures as $expenditure)
        <li>{{ $expenditure->description }} - {{ $expenditure->amount }}</li>
    @endforeach
</ul>
