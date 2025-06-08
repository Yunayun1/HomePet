<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PetAdopt</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts & CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ url('/') }}">PetAdopt</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <div class="d-flex align-items-center flex-nowrap justify-content-end">
                    @if (Request::is('/'))
                        @guest
                            <a href="{{ route('register') }}" class="btn text-white py-2 px-3 me-2"
                               style="background-color: #28A745; border-radius: 50px;">SignUp</a>
                            <a href="{{ route('login') }}" class="btn btn-outline-success py-2 px-3"
                               style="border-radius: 50px;">LogIn</a>
                        @else
                            @php
                                $nameParts = explode(' ', Auth::user()->name);
                                $initials = strtoupper(substr($nameParts[0], 0, 1));
                                if (count($nameParts) > 1) {
                                    $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                }
                            @endphp
                            <div class="dropdown me-3">
                                <a href="#" class="btn border border-success text-success rounded-circle d-flex align-items-center justify-content-center"
                                   style="width: 40px; height: 40px; font-weight: bold; font-size: 1rem; background-color: white;"
                                   id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $initials }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                    <li><a class="dropdown-item" href="{{ route('home') }}">Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign Out
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest

                        <a href="{{ url('/add-pet') }}" class="btn text-white py-2 px-3"
       style="background-color: #28A745; border-radius: 50px; white-space: nowrap;">
       <strong>+</strong> Add a Pet
    </a>
@endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
