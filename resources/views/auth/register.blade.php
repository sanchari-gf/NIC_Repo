@extends('layouts.app')

@section('content')

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<div class="container">
    <h2 class="text-center fw-bold mb-4">Register</h2>

    <div class="d-flex justify-content-center">
    <form method="POST" action="{{ route('register') }}" class="w-50 p-4 border rounded shadow-sm bg-light">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" placeholder="Enter Your Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label fw-bold">Email Address</label>
            <input type="email" placeholder="Enter Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password" placeholder="Enter Password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm Password" required>
        </div>


        <!-- Role dropdown -->
        <div class="form-group">
              <label for="role" class="form-label fw-bold">Role</label>
              <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required>
                  <option value="">Select a role</option>
                  <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                  <option value="Guest" {{ old('role') == 'Guest' ? 'selected' : '' }}>Guest</option>
              </select>
              @error('role')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
          </div>

          <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-primary">Register</button>
</div>

    </form>
</div>
</div>
@endsection
