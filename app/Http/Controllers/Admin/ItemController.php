<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\ItemGroup;

class ItemController extends Controller
{
    /**
     * Display a listing of item groups and their items.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
{
    // Retrieve the item group ID from the request
    $itemGroupId = $request->query('item_group_id');

    // Fetch the item group
    $itemGroup = ItemGroup::findOrFail($itemGroupId);

    // Fetch only items that belong to this item group
    $items = Item::where('item_group_id', $itemGroupId)->get();
    // dd($items);

    // Pass the item group and its items to the view
    return view('admin.item_groups.index_item', [
        'itemGroup' => $itemGroup,
        'items' => $items,
    ]);
}
    

    /**
     * Display a listing of items under a specific item group.
     *
     * @param  ItemGroup  $itemGroup
     * @return \Illuminate\View\View
     */
    public function indexItemsByGroup(ItemGroup $itemGroup)
    {
        // Fetch only items belonging to the specified item group
        $items = $itemGroup->items;

        return view('admin.item_groups.index_item', compact('itemGroup', 'items'));
    }

    /**
     * Show the form for creating a new item within an item group.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */

     public function create_item($itemGroupId)
     {
         $itemGroup = ItemGroup::find($itemGroupId);
     
         if (!$itemGroup) {
             abort(404, 'Item group not found');
         }
     
         return view('admin.item_groups.create_item', compact('itemGroup'));
     }


    
    public function create(Request $request)
    {
        // Get the item group ID passed from the route
        $itemGroupId = $request->query('item_group_id');
    
        // Pass the item group to the view
        $itemGroup = ItemGroup::find($itemGroupId);
        
        return view('admin.item_groups.create_item', compact('itemGroup'));
    }
    

    /**
     * Store a newly created item within a specified item group.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
   // Store the new item
   public function store(Request $request)
{
    // Get the item group ID from the request
    $itemGroupId = $request->input('item_group_id');

    // Validate and create the new item within the item group
    $itemGroup = ItemGroup::findOrFail($itemGroupId);
    $itemGroup->items()->create([
        'name' => $request->name,
        'price' => $request->price,
        'item_group_id' => $itemGroupId,
    ]);

    // Redirect to the index page for this item group
    return redirect()->route('item-groups.index')
                     ->with('success', 'Item added successfully to ' . $itemGroup->name);
}


public function edit($id)
{
    $item = Item::findOrFail($id);
    return view('admin.item_groups.edit_item', compact('item'));
}

public function update(Request $request, $id)
{
    // Validate the input data
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
    ]);

    // Find the item and update it
    $item = Item::findOrFail($id);
    $item->update([
        'name' => $request->name,
        'price' => $request->price,
    ]);

    // Redirect back to the items list with a success message
    return redirect()->route('items.index', ['item_group_id' => $item->item_group_id])
                     ->with('success', 'Item updated successfully.');
}


public function destroy($id)
{
    $item = Item::findOrFail($id);
    $item->delete();

    return redirect()->back()->with('success', 'Item deleted successfully.');
}




public function index_expenditure()
     {

          // Fetch the item groups
          $itemGroups = ItemGroup::all();
         
          // Optionally, you can load items if needed
          $items = Item::all();
          
          // Pass both the itemGroups and items to the view
          return view('expenditures.index_item', [
              'itemGroups' => $itemGroups, 
              'items' => $items,
              'itemGroup' => $itemGroups->first() // Pass the first item group or modify according to your needs
          ]);
     }



    
}
