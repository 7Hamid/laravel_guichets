<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login attempt
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect to intended page or home page after successful login
            return redirect()->intended(route('profile'))->with('success', 'You are logged in.');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Logout the user
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'))->with('success', 'You have been logged out.');
    }
}
