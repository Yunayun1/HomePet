<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Remove this, we'll override it below
    // protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirect users based on their role after login.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // 👈 send admin to admin dashboard
        }

        return redirect('/home'); // 👈 regular user/shelter goes here
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
}
