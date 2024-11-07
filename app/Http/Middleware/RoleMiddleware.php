<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        
        $user = Auth::user();
        // dd($user->role);

        // Debugging to check if user is authenticated and has correct role
        if (!$user) {
            return redirect('login');  // Redirect if user is not authenticated
        }

        // dd($user->role); // This will dump the user role and stop execution

        if ($user->role === $role) {
            return $next($request); // Allow access if roles match
        }

        return redirect('/');  // Redirect non-matching roles
    }
}
