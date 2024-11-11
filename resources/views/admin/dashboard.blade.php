@extends('layouts.admin') <!-- Assume you have an admin layout -->

@section('content')
    <div class="container mt-5">
        <h1 class="text-center fw-bold mb-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Total Users Card -->
            <div class="col-md-6 mb-4"> <!-- Added margin-bottom for spacing -->
                <a href="{{ route('admin.users') }}" class="text-decoration-none">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h2>Total Users</h2>
                            <p class="display-4">{{ $userCount }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Item Groups Card -->
            <div class="col-md-6 mb-4"> <!-- Added margin-bottom for spacing -->
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h2>Total Item Groups</h2>
                            <p class="display-4">{{ $itemGroupCount }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
