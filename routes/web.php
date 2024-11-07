<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemGroupController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenditureController;

use App\Http\Controllers\Auth\RegisterController;

use App\Models\ItemGroup;


use App\Models\Item;

// Admin Routes with Role Middleware
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    
    // Resource route for Item Groups (using ItemGroupController)
    Route::resource('item-groups', ItemGroupController::class);

     // Items under an Item Group
     Route::get('admin/items/create_item/{itemGroupId}', [ItemController::class, 'create_item'])->name('items.create_item');

     
     Route::post('/admin/items/{item_group_id}', [ItemController::class, 'store']);

     // In routes/web.php
Route::get('/admin/items', [ItemController::class, 'index'])->name('admin.items.index_item');

    // Additional specific routes for ItemGroupController if needed
    Route::get('item-groups/create', [ItemGroupController::class, 'create'])->name('item-groups.create');
    Route::post('item-groups/store', [ItemGroupController::class, 'store'])->name('item-groups.store');

    // Resource route for Items (using ItemController)
    Route::resource('items', ItemController::class)->except('show');


    // Define a route for creating items under a specific item group
Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('items', [ItemController::class, 'store'])->name('items.store');

    // Additional specific routes for ItemController if needed
    Route::post('items/store_item', [ItemController::class, 'store'])->name('items.store_item');
    
});





// Registered users with the 'Guest' role can add expenditures under all items
Route::middleware(['auth', 'role:Guest'])->group(function () {
   
    Route::get('guest/items/create', [ItemController::class, 'create'])->name('guest.items.create');
    Route::get('/guest/items', [ItemController::class, 'index_expenditure'])->name('guest.items.index');

    // Show the expenditures for a specific item
    Route::get('/expenditures/{item_id}', [ExpenditureController::class, 'show'])->name('expenditures.show');
    // Route for adding expenditure for a specific item
    Route::get('expenditures/{item_id}/create', [ExpenditureController::class, 'create'])->name('expenditures.create');
    Route::post('expenditures/{item_id}/store', [ExpenditureController::class, 'store'])->name('expenditures.store');



});



// Dashboard Route (Authenticated Users)
Route::middleware(['auth'])->get('/dashboard', function () {
    $itemGroups = ItemGroup::all();
    return view('admin.item_groups.index', ['itemGroups' => $itemGroups]);
})->name('dashboard');

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



