<?php

class LoginController extends Controller
{


// app/Http/Controllers/Auth/LoginController.php

protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');  // Redirect to admin dashboard
    }

    return redirect()->route('guest.dashboard');  // Or to guest dashboard for guests
}





}




?>