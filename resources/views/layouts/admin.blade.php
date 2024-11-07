<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Assuming Tailwind CSS or other styling is applied -->
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('item-groups.index') }}">Item Groups</a>
            <a href="{{ route('items.index') }}">Items</a> <!-- Example link to items management -->
        </nav>

        <!-- Add Logout Form -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Logout</button>
</form>

    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content can go here -->
    </footer>
</body>
</html>
