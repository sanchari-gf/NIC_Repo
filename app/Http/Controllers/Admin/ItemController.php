<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\ItemGroup; // Add this line at the top


class ItemController extends Controller
{
    

    /**
     * Display a listing of items.
     *
     * @return \Illuminate\View\View
     */


     public function create(Request $request)
{
    // Get the item group ID passed from the route
    $itemGroupId = $request->query('item_group_id');

    // Pass the item group to the view
    $itemGroup = ItemGroup::find($itemGroupId);
    
    return view('admin.item_groups.create_item', compact('itemGroup'));
}



     public function index()
     {
         // Fetch the item groups
         $itemGroups = ItemGroup::all();
         
         // Optionally, you can load items if needed
         $items = Item::all();
         
         // Pass both the itemGroups and items to the view
         return view('admin.item_groups.index_item', [
             'itemGroups' => $itemGroups, 
             'items' => $items,
             'itemGroup' => $itemGroups->first() // Pass the first item group or modify according to your needs
         ]);
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


    public function create_item($itemGroupId)
{
    $itemGroup = ItemGroup::find($itemGroupId);

    if (!$itemGroup) {
        abort(404, 'Item group not found');
    }

    return view('admin.item_groups.create_item', compact('itemGroup'));
}


     // Store the new item
     public function store(Request $request)
     {
         // Ensure item_group_id is passed correctly
         $itemGroupId = $request->route('item_group_id') ?? $request->input('item_group_id'); // Default to route or form input
     
         // Alternatively, if you're passing it in the URL like /create_item/{item_group_id}
         $itemGroup = ItemGroup::findOrFail($itemGroupId); // Ensure the ItemGroup exists
     
         // Create item under the specific Item Group
         $itemGroup->items()->create([
             'name' => $request->name,
             'price' => $request->price,
             'item_group_id' => $itemGroupId,
         ]);

         

    return redirect()->route('admin.items.index_item', $itemGroup->id);
}
}
