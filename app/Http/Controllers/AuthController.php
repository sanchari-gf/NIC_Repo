<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            // Check if the authenticated user has the 'Guest' role
            $user = Auth::user();
           
            if ($user->role === 'Guest') {
                return redirect()->route('guest.items.index');
            }

            // Default redirect for other roles (e.g., Admin)
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
