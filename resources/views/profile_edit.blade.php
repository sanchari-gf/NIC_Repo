<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.guest')

@section('content')
<div class="container">
    <h2 class="text-center fw-bold mb-4">Edit Profile</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="d-flex justify-content-center">
    <form method="POST" action="{{ route('profile_update') }}" class="w-50 p-4 border rounded shadow-sm bg-light">
    @csrf
    @method('PUT') <!-- Or POST depending on your form method -->
    
    <!-- Name field -->
    <div class="form-group">
        <label for="name" class="form-label fw-bold">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
    </div>

    <!-- Email field -->
    <div class="form-group">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
    </div>

    <!-- New Password field -->
    <div class="form-group">
        <label for="password" class="form-label fw-bold">New Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <!-- Password Confirmation field -->
    <div class="form-group">
        <label for="password_confirmation" class="form-label fw-bold">Confirm New Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>

    <div class="d-flex justify-content-end mt-3">
    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
    <a href="{{ route('guest.items.index') }}" class="btn btn-secondary">Cancel</a>
    </div>


</form>
</div>
</div>
@endsection
