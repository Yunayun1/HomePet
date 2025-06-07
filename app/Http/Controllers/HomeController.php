<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Require user to be logged in to access this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show page after login/register
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboard.admin'); // Admin dashboard
        }

        return view('index');  // Homepage for user & shelter
    }
}
