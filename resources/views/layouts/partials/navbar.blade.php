{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">Wellness</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('form.diet') }}" class="nav-link">Diet Plan</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('form.yoga') }}" class="nav-link">Yoga Batch</a>
                </li>

                {{-- Guest Links --}}
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Login</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-light ms-2">Register</a>
                    </li> --}}
                @endguest

                {{-- Auth Links --}}
                @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
