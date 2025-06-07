<nav>
    <!-- Your navbar content -->

    @guest
        <!-- If user not logged in -->
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @else
        <!-- If user logged in -->
        <a href="{{ url('/home') }}">Profile</a>

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
</nav>
