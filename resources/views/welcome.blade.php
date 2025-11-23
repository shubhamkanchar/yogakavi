<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness – Diet & Yoga</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Custom + AOS --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .hero {
            height: 100vh;
            background: linear-gradient(#00000080, #00000080),
                url('https://images.unsplash.com/photo-1552196563-55cd4e45efb3') center/cover;
            color: white;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            transition: 0.4s;
        }

        .card-hover {
            transition: transform 0.3s ease;
        }

        .slider-card {
            max-width: 600px;
            background: white;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .slider-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .testimonial-card {
            max-width: 650px;
            background: #fff;
        }

        .testimonial-text {
            font-size: 1rem;
            line-height: 1.7;
            color: #555;
        }

        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            filter: invert(1);
        }

        .professional-card ul li {
            margin-bottom: 8px;
            font-size: 15px;
            color: #555;
        }

        .plan-tag {
            padding: 6px 18px;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
            letter-spacing: 0.3px;
            font-size: 14px;
        }

        .professional-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease-in-out;
        }

        /* Ribbon */
        .ribbon {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff9800;
            padding: 6px 18px;
            font-weight: bold;
            font-size: 13px;
            color: #fff;
            border-radius: 6px;
            transform: rotate(8deg);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        #plans h2 {
            text-transform: uppercase;
            font-size: 28px;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Wellness</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#diet" class="nav-link">Diet Plan</a>
                    </li>

                    <li class="nav-item">
                        <a href="#yoga" class="nav-link">Yoga Batch</a>
                    </li>

                    {{-- Guest Links --}}
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-light ms-2">Register</a>
                        </li>
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

    <!-- HERO -->
    <section class="hero d-flex align-items-center text-center">
        <div class="container" data-aos="fade-up">
            <h1 class="display-4 fw-bold">Transform Your Health with Diet & Yoga</h1>
            <p class="lead mt-3">Personalized diet plans & energizing yoga batches designed for your wellness.</p>
            <a href="#diet" class="btn btn-light btn-lg mt-4">Get Started</a>
        </div>
    </section>

    <!-- SERVICES -->
    {{-- <section class="py-5">
    <div class="container">
        <div class="row text-center">

            <div class="col-md-6" data-aos="fade-right">
                <div class="card p-4 shadow card-hover">
                    <h3>Personalised Diet Plan</h3>
                    <p>Custom diet plans based on your lifestyle, body type & goals.</p>
                    <a href="#diet" class="btn btn-dark">Get Diet Plan</a>
                </div>
            </div>

            <div class="col-md-6 mt-3 mt-md-0" data-aos="fade-left">
                <div class="card p-4 shadow card-hover">
                    <h3>Yoga Batch Enrollment</h3>
                    <p>Join our morning or evening batches for complete body & mind wellness.</p>
                    <a href="#yoga" class="btn btn-dark">Join Yoga Batch</a>
                </div>
            </div>

        </div>
    </div>
</section> --}}
    <!-- YOGA BENEFIT SECTION -->
    <section class="py-5" style="background:#f9fafb;">
        <div class="container">
            <div class="row align-items-center">

                <!-- Illustration -->
                <div class="col-md-5 mb-4" data-aos="fade-right">
                    <img src="{{ asset('image/yoga.png') }}" class="img-fluid" alt="Yoga Illustration">
                </div>

                <!-- Text -->
                <div class="col-md-7" data-aos="fade-left">
                    <h2 class="fw-bold mb-3" style="color:#2b6777;">Benefits of Yoga</h2>
                    <p class="text-muted mb-4">
                        A disciplined yoga practice enhances your physical strength,
                        emotional balance and mental clarity.
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Improves flexibility & posture</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Reduces stress & anxiety</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Strengthens core & muscles</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Enhances breathing & lung capacity</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- DIET BENEFIT SECTION -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center flex-md-row-reverse">

                <!-- Illustration -->
                <div class="col-md-5 mb-4" data-aos="fade-left">
                    <img src="{{ asset('image/diet.png') }}" class="img-fluid" alt="Diet Illustration">
                </div>

                <!-- Text -->
                <div class="col-md-7" data-aos="fade-right">
                    <h2 class="fw-bold mb-3" style="color:#52a25a;">Benefits of a Personalized Diet</h2>
                    <p class="text-muted mb-4">
                        A tailored nutrition plan ensures sustainable results and
                        long-term well-being by aligning food choices with your goals.
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Healthy weight management</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Improves metabolism & digestion</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Balances nutrition & lifestyle</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex">
                                <span class="me-2">✔</span>
                                <p class="mb-0">Supports PCOS, diabetes & gut health</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    {{-- <section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">
            What Our Clients Say
        </h2>

        <div class="row g-4">

            <!-- Testimonial 1 -->
            <div class="col-md-4" data-aos="zoom-in">
                <div class="card shadow-lg border-0 p-4 text-center h-100 card-hover">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" 
                         class="rounded-circle mx-auto mb-3" 
                         width="80">
                    <h5 class="mb-1">Neha Sharma</h5>
                    <small class="text-muted">Diet Plan Client</small>
                    <p class="mt-3">
                        Amazing transformation! I lost 7kg in 8 weeks with the personalized diet plan. 
                        Highly recommended!
                    </p>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="card shadow-lg border-0 p-4 text-center h-100 card-hover">
                    <img src="https://randomuser.me/api/portraits/men/52.jpg" 
                         class="rounded-circle mx-auto mb-3" 
                         width="80">
                    <h5 class="mb-1">Raj Verma</h5>
                    <small class="text-muted">Yoga Batch Student</small>
                    <p class="mt-3">
                        The morning yoga sessions improved my flexibility and reduced stress. 
                        Best decision ever!
                    </p>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="card shadow-lg border-0 p-4 text-center h-100 card-hover">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" 
                         class="rounded-circle mx-auto mb-3" 
                         width="80">
                    <h5 class="mb-1">Pooja Desai</h5>
                    <small class="text-muted">Diet + Yoga</small>
                    <p class="mt-3">
                        A perfect combination of diet and yoga guidance. I feel healthier, 
                        energetic and confident.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section> --}}

    <!-- TESTIMONIAL SLIDER -->
    {{-- <section class="py-5" style="background: linear-gradient(135deg, #ffdee9 0%, #b5fffc 100%);">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" data-aos="fade-up">
                ❤️ Loved by Our Clients
            </h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="zoom-in">

                <div class="carousel-inner">

                    <!-- Slide 1 -->
                    <div class="carousel-item active text-center">
                        <div class="d-flex justify-content-center">
                            <div class="card shadow-lg p-5 border-0 rounded-4 slider-card">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                    class="rounded-circle mb-4 mx-auto" width="100">

                                <h4 class="fw-bold">Neha Sharma</h4>
                                <p class="text-muted">Diet Plan Client</p>

                                <p class="mt-3">
                                    “I lost 7kg in 2 months with the personalized diet plan.
                                    Simple, effective, and very motivating!”
                                </p>

                                <div class="mt-3 text-warning fs-4">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item text-center">
                        <div class="d-flex justify-content-center">
                            <div class="card shadow-lg p-5 border-0 rounded-4 slider-card">
                                <img src="https://randomuser.me/api/portraits/men/52.jpg"
                                    class="rounded-circle mb-4 mx-auto" width="100">

                                <h4 class="fw-bold">Raj Verma</h4>
                                <p class="text-muted">Yoga Batch Student</p>

                                <p class="mt-3">
                                    “Yoga sessions improved my flexibility, breathing and reduced stress.
                                    Best yoga coach ever!”
                                </p>

                                <div class="mt-3 text-warning fs-4">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item text-center">
                        <div class="d-flex justify-content-center">
                            <div class="card shadow-lg p-5 border-0 rounded-4 slider-card">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg"
                                    class="rounded-circle mb-4 mx-auto" width="100">

                                <h4 class="fw-bold">Pooja Desai</h4>
                                <p class="text-muted">Diet + Yoga</p>

                                <p class="mt-3">
                                    “Combination of diet + yoga changed my lifestyle.
                                    I feel more energetic and confident!”
                                </p>

                                <div class="mt-3 text-warning fs-4">
                                    ⭐⭐⭐⭐⭐
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                </button>

            </div>
        </div>
    </section> --}}

    <section class="py-5" style="background: linear-gradient(135deg, #ffdee9 0%, #b5fffc 100%);">
        <div class="container">

            <h2 class="text-center mb-5 fw-bold" data-aos="fade-up">
                What Our Clients Say
            </h2>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">

                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <div class="card p-4 p-md-5 border-0 rounded-4 shadow-lg testimonial-card text-center">

                                <img src="https://randomuser.me/api/portraits/women/44.jpg"
                                    class="rounded-circle mb-4 mx-auto shadow-sm" width="110" height="110">

                                <h4 class="fw-bold mb-1">Neha Sharma</h4>
                                <p class="text-muted small mb-3">Diet Plan Client</p>

                                <p class="testimonial-text">
                                    “I lost 7kg in just 2 months with her customized diet guidance.
                                    Very simple, easy to follow and super effective!”
                                </p>

                                <div class="mt-3 fs-5 text-warning">★★★★★</div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="card p-4 p-md-5 border-0 rounded-4 shadow-lg testimonial-card text-center">

                                <img src="https://randomuser.me/api/portraits/men/52.jpg"
                                    class="rounded-circle mb-4 mx-auto shadow-sm" width="110" height="110">

                                <h4 class="fw-bold mb-1">Raj Verma</h4>
                                <p class="text-muted small mb-3">Yoga Batch Student</p>

                                <p class="testimonial-text">
                                    “My flexibility improved drastically, stress reduced and breathing got better.
                                    Sessions are very calming and effective!”
                                </p>

                                <div class="mt-3 fs-5 text-warning">★★★★★</div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <div class="card p-4 p-md-5 border-0 rounded-4 shadow-lg testimonial-card text-center">

                                <img src="https://randomuser.me/api/portraits/women/65.jpg"
                                    class="rounded-circle mb-4 mx-auto shadow-sm" width="110" height="110">

                                <h4 class="fw-bold mb-1">Pooja Desai</h4>
                                <p class="text-muted small mb-3">Diet + Yoga Program</p>

                                <p class="testimonial-text">
                                    “Diet + Yoga together changed my lifestyle completely.
                                    I feel energized, confident and far more active!”
                                </p>

                                <div class="mt-3 fs-5 text-warning">★★★★★</div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                </button>
            </div>
        </div>
    </section>
    <!-- PLANS SECTION -->
    {{-- <section class="py-5" id="plans" style="background: linear-gradient(135deg, #fff8e7, #ffe6f7);">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" data-aos="fade-up"
                style="color:#ff4f81; text-shadow:0 2px 5px rgba(0,0,0,0.15);">
                Our Wellness Plans
            </h2>

            <div class="row g-4">

                <!-- Diet Plan -->
                <div class="col-md-4" data-aos="fade-right">
                    <div class="card shadow-lg p-4 text-center border-0 h-100 colorful-card"
                        style="border-radius:20px; background: #fff;">
                        <div class="plan-badge"
                            style="
                        background: linear-gradient(135deg, #ff9a9e, #fecfef);
                        padding:8px 16px;
                        border-radius:20px;
                        display:inline-block;
                        font-weight:600;
                        color:#fff;">
                            Diet Plan
                        </div>

                        <h2 class="fw-bold mt-3" style="color:#ff4f81;">₹999</h2>
                        <p class="small text-muted">One-Time Plan</p>

                        <ul class="list-unstyled mt-3 mb-4 colorful-list">
                            <li>🍎 Personalized weekly diet chart</li>
                            <li>📉 Weight tracking system</li>
                            <li>💬 WhatsApp Support</li>
                            <li>📅 7-Day Follow-ups</li>
                        </ul>

                        <a href="#diet" class="btn w-100"
                            style="background:#ff4f81; color:#fff; border-radius:10px;">
                            Get Diet Plan
                        </a>
                    </div>
                </div>

                <!-- Yoga Plan -->
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card shadow-lg p-4 text-center border-0 h-100 colorful-card"
                        style="border-radius:20px; background: #fff;">
                        <div class="plan-badge"
                            style="
                        background: linear-gradient(135deg, #84fab0, #8fd3f4);
                        padding:8px 16px;
                        border-radius:20px;
                        display:inline-block;
                        font-weight:600;
                        color:#fff;">
                            Yoga Batch
                        </div>

                        <h2 class="fw-bold mt-3" style="color:#33b679;">₹799</h2>
                        <p class="small text-muted">Per Month</p>

                        <ul class="list-unstyled mt-3 mb-4 colorful-list">
                            <li>🧘 Morning & Evening Batches</li>
                            <li>✨ Beginner Friendly</li>
                            <li>🎧 Guided Meditation</li>
                            <li>💪 Flexibility & Strength</li>
                        </ul>

                        <a href="#yoga" class="btn w-100"
                            style="background:#33b679; color:#fff; border-radius:10px;">
                            Join Yoga Batch
                        </a>
                    </div>
                </div>

                <!-- Combo Plan -->
                <div class="col-md-4" data-aos="fade-left">
                    <div class="card shadow-lg p-4 text-center border-0 h-100 colorful-card"
                        style="border-radius:20px; background: #fff; position:relative;">

                        <!-- Ribbon -->
                        <div
                            style="
                        position:absolute; top:-10px; right:-10px;
                        background:#ff9800; color:#fff;
                        padding:6px 18px; 
                        font-weight:bold;
                        border-radius:8px;
                        transform: rotate(10deg);
                        box-shadow:0 4px 10px rgba(0,0,0,0.2);">
                            Best Value
                        </div>

                        <div class="plan-badge"
                            style="
                        background: linear-gradient(135deg, #f6d365, #fda085);
                        padding:8px 16px;
                        border-radius:20px;
                        display:inline-block;
                        font-weight:600;
                        color:#fff;">
                            Combo Plan
                        </div>

                        <h2 class="fw-bold mt-3" style="color:#ff9800;">₹1499</h2>
                        <p class="small text-muted">Monthly Package</p>

                        <ul class="list-unstyled mt-3 mb-4 colorful-list">
                            <li>🍎 Personalized Diet Plan</li>
                            <li>🧘 Daily Yoga Sessions</li>
                            <li>📊 Monthly Progress Report</li>
                            <li>⚡ Priority Support</li>
                        </ul>

                        <a href="#combo" class="btn w-100"
                            style="background:#ff9800; color:#fff; border-radius:10px;">
                            Choose Combo Plan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    <section class="py-5" id="plans" style="background: #f9fafc;">
        <div class="container">

            <h2 class="text-center mb-5 fw-bold" data-aos="fade-up" style="color:#333; letter-spacing:0.5px;">
                Our Wellness Plans
            </h2>

            <div class="row g-4">

                <!-- Diet Plan -->
                <div class="col-md-4" data-aos="fade-right">
                    <div class="card professional-card text-center h-100 border-0 shadow-sm rounded-4 p-4">

                        <div class="plan-tag bg-primary text-white">Diet Plan</div>

                        <h2 class="fw-bold mt-3" style="color:#007bff;">₹999</h2>
                        <p class="small text-muted">One-Time Plan</p>

                        <ul class="list-unstyled mt-3 mb-4">
                            <li>✔ Personalized weekly diet chart</li>
                            <li>✔ Weight tracking system</li>
                            <li>✔ WhatsApp Support</li>
                            <li>✔ 7-Day Follow-ups</li>
                        </ul>

                        <a href="#diet" class="btn btn-primary w-100 rounded-3">
                            Get Diet Plan
                        </a>
                    </div>
                </div>

                <!-- Yoga Plan -->
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card professional-card text-center h-100 border-0 shadow-sm rounded-4 p-4">

                        <div class="plan-tag bg-success text-white">Yoga Batch</div>

                        <h2 class="fw-bold mt-3" style="color:#28a745;">₹799</h2>
                        <p class="small text-muted">Per Month</p>

                        <ul class="list-unstyled mt-3 mb-4">
                            <li>✔ Morning & Evening Batches</li>
                            <li>✔ Beginner Friendly</li>
                            <li>✔ Guided Meditation</li>
                            <li>✔ Flexibility & Strength Training</li>
                        </ul>

                        <a href="#yoga" class="btn btn-success w-100 rounded-3">
                            Join Yoga Batch
                        </a>
                    </div>
                </div>

                <!-- Combo Plan -->
                <div class="col-md-4" data-aos="fade-left">
                    <div
                        class="card professional-card text-center h-100 border-0 shadow-sm rounded-4 p-4 position-relative">

                        <div class="ribbon">Best Value</div>

                        <div class="plan-tag bg-warning text-white">Combo Plan</div>

                        <h2 class="fw-bold mt-3" style="color:#ff9800;">₹1499</h2>
                        <p class="small text-muted">Monthly Package</p>

                        <ul class="list-unstyled mt-3 mb-4">
                            <li>✔ Personalized Diet Plan</li>
                            <li>✔ Daily Yoga Sessions</li>
                            <li>✔ Monthly Progress Report</li>
                            <li>✔ Priority Support</li>
                        </ul>

                        <a href="#combo" class="btn btn-warning w-100 text-white rounded-3">
                            Choose Combo Plan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DIET FORM -->
    <section id="diet" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="fade-up">Get Your Personalised Diet Plan</h2>

            <div class="row justify-content-center">
                <div class="col-md-6">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('diet.lead') }}" data-aos="zoom-in">
                        @csrf

                        <div class="mb-3">
                            <label>Your Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Your Goal</label>
                            <select name="goal" class="form-control" required>
                                <option value="">Select Goal</option>
                                <option>Weight Loss</option>
                                <option>Weight Gain</option>
                                <option>Diabetes Control</option>
                                <option>PCOS/PCOD Diet</option>
                                <option>Healthy Lifestyle</option>
                            </select>
                        </div>

                        <button class="btn btn-dark w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- YOGA FORM -->
    <section id="yoga" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="fade-up">Join Yoga Batch</h2>

            <div class="row justify-content-center">
                <div class="col-md-6">

                    <form method="POST" action="{{ route('yoga.lead') }}" data-aos="zoom-in">
                        @csrf

                        <div class="mb-3">
                            <label>Your Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Select Batch Time</label>
                            <select name="batch_time" class="form-control" required>
                                <option value="">Choose Time</option>
                                <option>6:00 AM – 7:00 AM</option>
                                <option>7:00 AM – 8:00 AM</option>
                                <option>6:00 PM – 7:00 PM</option>
                            </select>
                        </div>

                        <button class="btn btn-dark w-100">Join Now</button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© {{ date('Y') }} Wellness – Diet & Yoga | All Rights Reserved</p>
    </footer>

</body>

</html>
