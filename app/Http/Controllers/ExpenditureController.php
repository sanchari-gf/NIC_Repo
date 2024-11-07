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
        return redirect()->route('expenditures.show', ['item_id' => $item_id])
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
    $expenditures = $item->expenditures;  // Assuming a relationship is defined
    return view('expenditures.index', compact('item', 'expenditures'));
}
}

