<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemGroup;
use Illuminate\Http\Request;


class ItemGroupController extends Controller
{
    // In ItemGroupController.php
    public function index()
    {
        $itemGroups = ItemGroup::all(); // or whatever data you need
        return view('admin.item_groups.index', compact('itemGroups'));
    }


    


    public function create()
    {
        return view('admin.item_groups.create');
    }

    public function store(Request $request)
{
    // Validate the item group name to be unique
    $request->validate([
        'name' => 'required|unique:item_groups|max:255'
    ], [
        'name.unique' => 'This Item Group name already exists. Please choose a different name.'
    ]);

    // If validation passes, create the new item group
    ItemGroup::create($request->all());

    // Redirect to the index with a success message
    return redirect()->route('item-groups.index')->with('success', 'Item Group created successfully.');
}

    

    public function edit(ItemGroup $itemGroup)
    {
        return view('admin.item_groups.edit', compact('itemGroup'));
    }

    public function update(Request $request, ItemGroup $itemGroup)
    {
        $request->validate([
            'name' => 'required|max:255|unique:item_groups,name,' . $itemGroup->id
        ]);

        $itemGroup->update($request->all());

        return redirect()->route('item-groups.index')->with('success', 'Item Group updated successfully.');
    }

    public function destroy(ItemGroup $itemGroup)
    {
        $itemGroup->delete();

        return redirect()->route('item-groups.index')->with('success', 'Item Group deleted successfully.');
    }
}
