<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
 


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-blue-500 to-blue-700 min-h-screen flex items-center justify-center">
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        
     <!-- Display the success message if it exists -->
     @if(session('success'))
     <div class="alert text-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" required class="login-input">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                <input type="password" name="password" id="password" required class="login-input">
            </div>

            <button type="submit" class="login-button">
                Login
            </button>

            <div class="text-center mt-4 register-link">
                <a class="register-text" href="{{ route('register') }}">
                    Don't have an account? <span class="text-blue-500 hover:underline">Register here</span>
                </a>
            </div>
        </form>
    </div>
</body>

</html>
