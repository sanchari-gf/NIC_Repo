@extends('layouts.admin')

@section('content')
    <h1>Create Item Group</h1>

    <!-- Form to create a new Item Group -->
    <form action="{{ route('item-groups.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <button type="submit">Create</button>
    </form>
@endsection
