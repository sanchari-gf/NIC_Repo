<!-- resources/views/admin/item_groups/create_item.blade.php -->
@extends('layouts.admin')

@section('content')
<h1>Create Item for Group: {{ $itemGroup ? $itemGroup->name : 'Unknown Group' }}</h1>



    <form action="{{ route('items.store', $itemGroup->id) }}" method="POST">
        @csrf
        <label for="name">Item Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>
        <br>


        <!-- Hidden field to include item_group_id -->
    <input type="hidden" name="item_group_id" value="{{ $itemGroup->id }}">

        <button type="submit">Create Item</button>
    </form>
@endsection
