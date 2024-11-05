<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Show the user profile page
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('profile', compact('user'));
    }

}
