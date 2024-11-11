@extends('layouts.admin')

@section('content')
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <h1 class="login-title fw-bold">Users</h1> <!-- Centering the title using text-center class -->

  
    <!-- Display the success message if it exists -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="mb-3">
        <a href="{{ route('dashboard_admin') }}" class="btn btn-secondary">Back to Dashboard</a>
        
    </div>

    <!-- Display the success message if it exists -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

 
 

    

    @if($users->isEmpty())
        <p>No item groups found.</p>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
            @php $counter = 1; @endphp
            @foreach($users as $user)
                <tr>
                    <td>{{ sprintf('%d', $counter++) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" aria-label="Delete item group">Delete</button>
                        </form>
                       
                      
                    </td>
               

                    
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
