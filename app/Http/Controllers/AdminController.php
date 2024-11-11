<?php

namespace App\Http\Controllers;

use App\Models\User; // Corrected import for User model
use App\Models\ItemGroup;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count(); // Corrected to User model
        $itemGroupCount = ItemGroup::count();
        
        return view('admin.dashboard', compact('userCount', 'itemGroupCount'));
    }

    public function users()
{
    $users = User::all(); // Adjust the query as needed

    return view('admin.users', compact('users'));
}

// Method to handle user deletion
public function destroy($id)
{
    // Find the user by their ID
    $user = User::findOrFail($id);

    // Perform the deletion
    $user->delete();

    // Redirect or return a response after deletion
    return redirect()->route('admin.users')->with('success', 'User deleted successfully');
}


public function edit_admin()
    {
        $user = Auth::user();

         // If using base64 encoding for password, no need to decrypt
        $decryptedPassword = $user->password; // This is base64 encoded or the actual password.

        return view('profile_edit', compact('user', 'decryptedPassword'));
    }

    public function update_admin(Request $request)
{
    $user = Auth::user();

    // Validate incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',  // Laravel will automatically check the confirmation field
    ]);

    // Update name and email
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];

    // Update password if provided
    if ($request->filled('password')) {
        // Hash the password before saving it securely
        $user->password = Hash::make($validatedData['password']);
    }

    $user->save();

    return redirect()->route('admin.users')->with('success', 'Profile updated successfully!');
}

    

}
