<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('welcome') }}" style="color: #2c3e50; letter-spacing: -0.5px;">
            <i class="bi bi-heart-pulse-fill text-primary me-2"></i>{{ config('app.name', 'Yogakavi') }}
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a href="{{ route('welcome') }}#home" class="nav-link fw-bold px-3">Home</a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('welcome') }}#why-us" class="nav-link fw-bold px-3">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('form.yoga') }}" class="nav-link fw-bold px-3">Yoga</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('form.diet') }}" class="nav-link fw-bold px-3">Diet</a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('welcome') }}#testimonials" class="nav-link fw-bold px-3">Stories</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('welcome') }}#plans" class="nav-link fw-bold px-3">Plans</a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('blogs.index') }}" class="nav-link fw-bold px-3 @if(request()->routeIs('blogs.*')) active @endif">Blogs</a>
                </li>
                  <li class="nav-item">
                    <a href="{{ route('gallery.index') }}" class="nav-link fw-bold px-3 @if(request()->routeIs('gallery.index')) active @endif">Gallery</a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('welcome') }}#contact" class="nav-link fw-bold px-3">Contact</a>
                </li>

                {{-- Guest Links --}}
                @guest
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Login</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-light ms-2">Register</a>
                    </li> --}}
                @endguest

                {{-- Auth Links --}}
                @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle fw-bold text-primary" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->full_name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3">
                             <li>
                                <div class="px-3 py-2 text-muted small">Signed in as <br> <strong>{{ Auth::user()->email }}</strong></div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 text-danger" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
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

<style>
    .nav-link {
        color: #5a6b7c;
        transition: color 0.3s;
    }
    .nav-link:hover, .nav-link.active {
        color: #667eea !important;
    }
</style>
