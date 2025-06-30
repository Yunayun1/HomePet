<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Show dashboard with summary counts
    public function index()
    {
        $totalPets = Pet::count();
        $totalApplications = AdoptionApplication::count();
        $activeUsers = User::where('role', '!=', 'admin')->count();

        return view('admin.dashboard.index', compact('totalPets', 'totalApplications', 'activeUsers'));
    }

    // API endpoint for statistics (for charts)
    public function statistics(Request $request)
    {
        $filter = $request->get('filter', 'month'); // day, week, month

        // Determine date range based on filter
        switch ($filter) {
            case 'day':
                $startDate = Carbon::now()->subDay();
                $format = 'H'; // Hour
                $labelFormat = 'H:00'; // e.g. 14:00
                $periods = 24;
                break;

            case 'week':
                $startDate = Carbon::now()->subWeek();
                $format = 'Y-m-d'; // Date
                $labelFormat = 'D'; // Day abbreviation Mon, Tue
                $periods = 7;
                break;

            case 'month':
            default:
                $startDate = Carbon::now()->subDays(30);
                $format = 'Y-m-d'; // Date
                $labelFormat = 'M d'; // e.g. Jun 10
                $periods = 30;
                break;
        }

        // Prepare labels array (time buckets)
        $labels = [];
        for ($i = 0; $i < $periods; $i++) {
            $labels[] = $filter === 'day'
                ? $startDate->copy()->addHours($i)->format($labelFormat)
                : $startDate->copy()->addDays($i)->format($labelFormat);
        }

        // Initialize data arrays
        $pendingData = array_fill(0, $periods, 0);
        $rejectedData = array_fill(0, $periods, 0);
        $totalData = array_fill(0, $periods, 0);

        // Query adoption applications within date range
        $applications = AdoptionApplication::where('created_at', '>=', $startDate)->get();

        // Bucket applications by period index and status
        foreach ($applications as $app) {
            if ($filter === 'day') {
                $index = $app->created_at->diffInHours($startDate);
            } else {
                $index = $app->created_at->diffInDays($startDate);
            }
            if ($index >= 0 && $index < $periods) {
                $totalData[$index]++;
                if ($app->status === 'pending') {
                    $pendingData[$index]++;
                } elseif ($app->status === 'rejected') {
                    $rejectedData[$index]++;
                }
            }
        }

        return response()->json([
            'labels' => $labels,
            'pending' => $pendingData,
            'rejected' => $rejectedData,
            'total' => $totalData,
        ]);
    }
}
