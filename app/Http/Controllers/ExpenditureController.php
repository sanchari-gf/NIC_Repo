<?php

// app/Http/Controllers/ExpenditureController.php
namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenditureController extends Controller
{
  

    // Show a form to add expenditure
    public function create($itemId)
    {
        $item = Item::findOrFail($itemId);
        return view('expenditures.create', compact('item'));
    }

    // Store a new expenditure
    public function store(Request $request, $item_id)
    {
        // Validate the input
        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);

        // Create the expenditure, ensuring you link it to the item and user
        Expenditure::create([
            'amount' => $validated['amount'],
            'item_id' => $item_id,
            'user_id' => auth()->id(),  // Assuming the logged-in user is associated
        ]);

        // Redirect the user back to the item page, or another page as needed
        return redirect()->route('guest.items.index', ['item_id' => $item_id])
                         ->with('success', 'Expenditure added successfully!');
    }

    // Show the user's expenditures
    public function index()
    {
        // Get only the logged-in user's expenditures
        $expenditures = Expenditure::where('user_id', Auth::id())->get();
        return view('expenditures.index', compact('expenditures'));
    }


    

  // Method to show the expenditures for a specific item



public function show($item_id)
{
    $item = Item::findOrFail($item_id);

    // Get only the expenditures for the current user for this specific item
    $expenditures = $item->expenditures()->where('user_id', auth()->id())->get();

    // Calculate the total expenditure for the item
    $totalExpenditure = $expenditures->sum('amount');

    return view('expenditures.index', compact('item', 'expenditures', 'totalExpenditure'));
}

public function destroy($id)
{
    $expenditure = Expenditure::findOrFail($id);
    $expenditure->delete();

   // Assuming you have an `item_id` that the `expenditures.show` route requires
   $itemId = $expenditure->item_id; // Or however you get the item_id related to the expenditure

   return redirect()->route('expenditures.show', ['item_id' => $itemId])
       ->with('success', 'Expenditure deleted successfully');
}



public function edit($id)
{
    $expenditure = Expenditure::findOrFail($id);
    $items = Item::all(); // Retrieve all items or filter them as needed

    return view('expenditures.edit', compact('expenditure', 'items'));
}



public function update(Request $request, $id)
{
    $expenditure = Expenditure::findOrFail($id);
    // Assuming you have an `item_id` that the `expenditures.show` route requires
   $itemId = $expenditure->item_id; // Or however you get the item_id related to the expenditure

    // Validate and update
    $request->validate([
        'amount' => 'required|numeric',
        'item_id' => 'required|exists:items,id',
    ]);

    $expenditure->update([
        'amount' => $request->amount,
        'item_id' => $request->item_id,
    ]);

    return redirect()->route('expenditures.show', ['item_id' => $itemId])
    ->with('success', 'Expenditure updated successfully');
}

}

