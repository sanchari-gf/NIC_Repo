<!-- resources/views/admin/item_groups/edit.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Edit Item Group</h1>

    <form action="{{ route('item-groups.update', $itemGroup) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $itemGroup->name }}" required>
        <button type="submit">Update</button>
    </form>
@endsection
