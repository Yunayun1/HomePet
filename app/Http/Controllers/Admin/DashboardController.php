<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pet;
use App\Models\AdoptionApplication;

class DashboardController extends Controller
{
    public function index()
    {
        // Count total pets
        $totalPets = Pet::count();

        // Count total adoption applications
        $totalApplications = AdoptionApplication::count();

        // Count active users (excluding admins)
        $activeUsers = User::where('role', '!=', 'admin')->count();

        // Pass counts to dashboard view
        return view('admin.dashboard.index', compact(
            'totalPets',
            'totalApplications',
            'activeUsers'
        ));
    }
}
