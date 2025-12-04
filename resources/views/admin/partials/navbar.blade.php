<!-- 🌟 TOP NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
    <div class="container-fluid">

        <!-- Sidebar Toggle Button -->
        <button class="btn btn-dark me-3" id="toggleSidebar">
            <i class="bi bi-list fs-4"></i>
        </button>

        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">{{ env('APP_NAME') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- <div class="collapse navbar-collapse" id="navmenu">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#"><i class="bi bi-bell"></i> Notifications</a>
                </li>

                <li class="nav-item mx-2">
                    <a class="nav-link" href="#"><i class="bi bi-gear"></i> Settings</a>
                </li>

                <li class="nav-item mx-2 d-flex align-items-center">
                    <img src="https://i.pravatar.cc/36" class="rounded-circle me-2" width="35">
                    <a class="nav-link" href="#">Admin</a>
                </li>
            </ul>
        </div> --}}
        <div class="collapse navbar-collapse" id="navmenu">

            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                    <a href="#diet" class="nav-link">Diet Plan</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('form.yoga') }}" class="nav-link">Yoga Batch</a>
                </li> --}}

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
                            {{ Auth::user()->full_name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
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
