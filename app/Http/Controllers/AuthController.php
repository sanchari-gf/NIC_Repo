<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // Add Hash facade for secure password handling

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'Guest') {
                return redirect()->route('guest.items.index');
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

         // If using base64 encoding for password, no need to decrypt
        $decryptedPassword = $user->password; // This is base64 encoded or the actual password.

        return view('profile_edit', compact('user', 'decryptedPassword'));
    }

    public function update(Request $request)
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

    return redirect()->route('guest.items.index')->with('success', 'Profile updated successfully!');
}

}
