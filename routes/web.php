<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ItemGroupController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ExpenditureController;




use App\Models\ItemGroup;

// Admin Routes with Role Middleware
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {

  

    

    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    Route::get('/profile_edit_admin', [AdminController::class, 'edit_admin'])->name('profile_edit_admin');
    Route::put('/profile_update_admin', [AdminController::class, 'update_admin'])->name('profile_update_admin');


    // Admin Dashboard
    Route::get('/admin/dashboard_admin', [AdminController::class, 'dashboard'])->name('dashboard_admin');

    //user view
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');




    // Resource routes for Item Groups and Items
    Route::resource('item-groups', ItemGroupController::class);
    Route::resource('items', ItemController::class)->except('show');

    // Custom route for creating items under a specific Item Group
    Route::get('items/create_item/{itemGroupId}', [ItemController::class, 'create_item'])->name('items.create_item');
});

// Guest (User Role) Routes
Route::middleware(['auth', 'role:Guest'])->group(function () {
    // Items for Guests
    Route::get('guest/items', [ItemController::class, 'index_expenditure'])->name('guest.items.index');
    Route::get('guest/items/create', [ItemController::class, 'create'])->name('guest.items.create');

    // Expenditure Routes
    Route::get('expenditures/{item_id}', [ExpenditureController::class, 'show'])->name('expenditures.show');
    Route::get('expenditures/{item_id}/create', [ExpenditureController::class, 'create'])->name('expenditures.create');
    Route::post('expenditures/{item_id}/store', [ExpenditureController::class, 'store'])->name('expenditures.store');
    Route::get('expenditures/{expenditure}/edit', [ExpenditureController::class, 'edit'])->name('expenditures.edit');
    Route::put('expenditures/{expenditure}', [ExpenditureController::class, 'update'])->name('expenditures.update');
    Route::delete('expenditures/{expenditure}', [ExpenditureController::class, 'destroy'])->name('expenditures.destroy');
});

// Authenticated User Dashboard Route
Route::middleware(['auth'])->get('/dashboard', function () {
    $itemGroups = ItemGroup::all();
    return view('admin.item_groups.index', ['itemGroups' => $itemGroups]);
})->name('dashboard');



Route::middleware(['auth'])->group(function () {
    // Profile route
    Route::get('/profile_edit', [AuthController::class, 'edit'])->name('profile_edit');
    Route::put('/profile_update', [AuthController::class, 'update'])->name('profile_update');
});


// Public Routes
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
