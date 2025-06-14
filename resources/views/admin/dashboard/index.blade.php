@extends('layouts.admin')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!--
    Load Tailwind CSS from CDN.
    For production, it's recommended to compile Tailwind CSS into your assets.
    -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            <!--
            This card displays the count of active users.
            The value `{{ $activeUsersCount }}` is passed from the PHP controller.
            -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4 text-white text-center rounded-t-lg">
                    <h3 class="text-xl font-bold">Active Users</h3>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-5xl font-extrabold text-gray-800 mb-2">
                            <!-- Blade syntax to display the PHP variable -->
                            {{ $activeUsersCount }}
                        </p>
                        <p class="text-gray-600 text-sm">currently active on the platform</p>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex justify-end">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                            View All Users
                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div> <!-- End of Dashboard Content Grid -->

    </div>
</body>
</html>

@endsection
