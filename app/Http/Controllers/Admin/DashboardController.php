<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $activeUsersCount = User::where('is_banned', false)
            ->where('role', '!=', 'admin')
            ->count();

        return view('admin.dashboard.index', compact('activeUsersCount'));
    }
}
