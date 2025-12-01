@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- HERO -->
    <section class="hero d-flex align-items-center text-center">
        <div class="container" data-aos="fade-up">
            <h1 class="display-4 fw-bold">Transform Your Health with Diet & Yoga</h1>
            <p class="lead mt-3">Personalized diet plans & energizing yoga batches designed for your wellness.</p>
            <a href="#diet" class="btn btn-light btn-lg mt-4">Get Started</a>
        </div>
    </section>

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
@endsection

