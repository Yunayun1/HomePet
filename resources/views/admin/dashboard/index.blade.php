@extends('layouts.admin')

@section('content')
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
    </style>
</head>

<body class="antialiased">

    <div class="min-h-screen bg-gray-100 p-6 flex flex-col items-center">

        <!-- Page Header -->
        <header class="w-full max-w-4xl mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 text-center md:text-left">
                Dashboard Overview
            </h1>
            <p class="mt-2 text-gray-600 text-center md:text-left">
                Welcome back, Admin! Here's a quick look at your platform's statistics.
            </p>
        </header>

        <!-- Dashboard Content Grid -->
        <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Active Users Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4 text-white text-center rounded-t-lg">
                    <h3 class="text-xl font-bold">Active Users</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-5xl font-extrabold text-gray-800 mb-2">
                            {{ $activeUsers ?? '0' }}
                        </p>
                        <p class="text-gray-600 text-sm">currently active on the platform</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                            View All Users
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Pets Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4 text-white text-center rounded-t-lg">
                    <h3 class="text-xl font-bold">Total Pets</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-5xl font-extrabold text-gray-800 mb-2">
                            {{ $totalPets ?? '0' }}
                        </p>
                        <p class="text-gray-600 text-sm">pets available in the system</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.managepet.index') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800 transition duration-150 ease-in-out">
                            Manage Pets
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Applications Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="bg-gradient-to-r from-purple-500 to-violet-600 p-4 text-white text-center rounded-t-lg">
                    <h3 class="text-xl font-bold">Applications</h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-5xl font-extrabold text-gray-800 mb-2">
                            {{ $totalApplications ?? '0' }}
                        </p>
                        <p class="text-gray-600 text-sm">adoption applications received</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.adoptions.index') }}" class="inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-800 transition duration-150 ease-in-out">
                            View Applications
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Filter Dropdown -->
        <div class="w-full max-w-4xl mt-8 flex items-center justify-center space-x-4">
            <label for="filter" class="text-gray-700 font-semibold">Filter by:</label>
            <select id="filter" class="border border-gray-300 rounded p-2">
                <option value="day">Last 24 Hours</option>
                <option value="week">Last 7 Days</option>
                <option value="month" selected>Last 30 Days</option>
            </select>
        </div>

        <!-- Charts Container -->
        <div class="w-full max-w-4xl mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Line Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold mb-4 text-center">Requests Over Time</h3>
                <canvas id="lineChart" width="400" height="300"></canvas>
            </div>

            <!-- Donut Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold mb-4 text-center">Request Status Breakdown</h3>
                <canvas id="donutChart" width="400" height="300"></canvas>
            </div>

        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const filterSelect = document.getElementById('filter');
    let lineChart, donutChart;

    function fetchStatistics(filter = 'month') {
        fetch(`{{ route('admin.dashboard.statistics') }}?filter=${filter}`)
            .then(res => res.json())
            .then(data => {
                updateLineChart(data);
                updateDonutChart(data);
            });
    }

    function updateLineChart(data) {
        const ctx = document.getElementById('lineChart').getContext('2d');

        if(lineChart) lineChart.destroy();

        lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Pending',
                        data: data.pending,
                        borderColor: 'rgba(255, 206, 86, 1)',
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        fill: true,
                        tension: 0.3,
                    },
                    {
                        label: 'Rejected',
                        data: data.rejected,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true,
                        tension: 0.3,
                    },
                    {
                        label: 'Total',
                        data: data.total,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.3,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true },
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
            }
        });
    }

    function updateDonutChart(data) {
        const ctx = document.getElementById('donutChart').getContext('2d');

        if(donutChart) donutChart.destroy();

        // Calculate approved as total - pending - rejected for each time slot then sum
        const sumPending = data.pending.reduce((a,b) => a+b, 0);
        const sumRejected = data.rejected.reduce((a,b) => a+b, 0);
        const sumTotal = data.total.reduce((a,b) => a+b, 0);
        const sumApproved = sumTotal - sumPending - sumRejected;

        donutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Rejected', 'Approved'],
                datasets: [{
                    label: 'Request Status',
                    data: [sumPending, sumRejected, sumApproved],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });
    }

    // Initial load
    fetchStatistics(filterSelect.value);

    // On filter change
    filterSelect.addEventListener('change', () => {
        fetchStatistics(filterSelect.value);
    });
</script>

</body>
@endsection
