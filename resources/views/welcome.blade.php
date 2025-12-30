@extends('layouts.app')

@section('style')
    <style>
        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(135deg, #e0f7fa 0%, #fbe4eb 100%);
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-weight: 800;
            color: #2c3e50;
            letter-spacing: -0.5px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #5a6b7c;
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
        }

        .btn-gradient-primary {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(118, 75, 162, 0.3);
            color: white;
        }

        /* --- Section Titles --- */
        .section-title {
            font-weight: 800;
            color: #2c3e50;
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #ff6b6b;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* --- Feature Cards (Why Choose Us) --- */
        .feature-box {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
            border-color: transparent;
        }

        .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* --- Pricing Cards --- */
        .pricing-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s;
            overflow: hidden;
            background: white;
        }

        .pricing-card:hover {
            transform: scale(1.02);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
        }

        .popular-badge {
            position: absolute;
            top: 20px;
            right: -30px;
            background: #ff6b6b;
            color: white;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 0.85rem;
            font-weight: 700;
            box-shadow: 0 2px 10px rgba(255, 107, 107, 0.3);
        }

        /* --- Contact Form --- */
        .contact-box {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.05);
        }

        .form-control-lg {
            border-radius: 10px;
            font-size: 0.95rem;
            padding: 1rem;
            border: 2px solid #f1f3f5;
        }

        .form-control-lg:focus {
            box-shadow: none;
            border-color: #667eea;
        }

        /* --- Testimonials --- */
        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            margin: 20px 0; /* space for shadow */
        }
        
        .quote-icon {
            font-size: 4rem;
            color: #f1f3f5;
            position: absolute;
            top: 10px;
            left: 20px;
            z-index: 0;
        }

        /* --- Mobile Responsive Adjustments --- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0 50px;
            }
            .hero-title {
                font-size: 2.5rem; /* Smaller H1 */
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .display-3 {
                font-size: 2.5rem; /* Global display reduce */
            }
            
            /* Reduce padding on cards/boxes */
            .testimonial-card, 
            .pricing-card .card-body,
            .contact-box .bg-dark, 
            .contact-box .bg-white {
                padding: 1.5rem !important;
            }
            
            /* Adjust blobs */
            .position-absolute.rounded-circle.opacity-10 {
                width: 150px !important;
                height: 150px !important;
            }
            
            /* Testimonial Quote Icon */
            .quote-icon {
                font-size: 3rem;
                left: 10px;
                top: 5px;
            }
            
            /* Carousel arrows */
            .carousel-control-prev, .carousel-control-next {
                width: 10% !important;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-4" style="z-index: 1050;" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- 1. HERO SECTION -->
    <header id="home" class="hero-section d-flex align-items-center text-center">
        <div class="container" data-aos="fade-up">
            <span class="badge bg-white text-primary shadow-sm rounded-pill px-3 py-2 mb-3 fw-bold text-uppercase" style="letter-spacing: 1px;">
                Start Your Journey Today
            </span>
            <h1 class="display-3 hero-title mb-3">
                Transform Your Body,<br> <span style="color: #667eea;">Calm Your Mind</span>
            </h1>
            <p class="hero-subtitle mb-5">
                Join <strong>Yogakavi</strong> for personalized diet plans and energizing yoga sessions designed 
                specifically for your lifestyle and wellness goals.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#plans" class="btn btn-gradient-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow">
                    Get Started <i class="bi bi-arrow-right ms-2"></i>
                </a>
                <a href="#contact" class="btn btn-white btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm" style="background:white; color:#2c3e50;">
                    Contact Us
                </a>
            </div>
        </div>
    </header>

    <!-- 2. WHY CHOOSE US -->
    <section id="why-us" class="py-5" style="background: #fff;">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Why Choose Us</h2>
                <p class="text-muted mt-3">We don't just instruct; we partner in your wellness journey.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box text-center">
                        <div class="icon-circle bg-light text-primary mx-auto">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Certified Experts</h5>
                        <p class="text-muted small mb-0">Learn from certified yoga trainers and nutritionists with years of experience.</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box text-center">
                        <div class="icon-circle bg-light text-success mx-auto">
                            <i class="bi bi-person-heart"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Personalized Care</h5>
                        <p class="text-muted small mb-0">Every body is unique. We customize plans that fit your specific needs.</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box text-center">
                        <div class="icon-circle bg-light text-warning mx-auto">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Proven Results</h5>
                        <p class="text-muted small mb-0">Join hundreds of happy clients who have transformed their lives.</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box text-center">
                        <div class="icon-circle bg-light text-info mx-auto">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Affordable</h5>
                        <p class="text-muted small mb-0">Premium wellness guidance at prices that don't break the bank.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. YOGA BENEFITS -->
    <section id="yoga" class="py-5" style="background: #f8fafc;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 position-relative" data-aos="fade-right">
                    <div class="position-absolute bg-primary rounded-circle opacity-10" style="width: 300px; height: 300px; top: -20px; left: -20px;"></div>
                    <img src="{{ asset('image/yoga.png') }}" class="img-fluid position-relative rounded-4 shadow-lg" alt="Yoga Illustration">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ps-lg-5">
                        <h6 class="text-primary fw-bold text-uppercase mb-2">Finding Balance</h6>
                        <h2 class="fw-bold mb-4 display-6">Rediscover Yourself Through <span class="text-primary">Yoga</span></h2>
                        <p class="lead text-muted mb-4">A disciplined yoga practice enhances your physical strength, emotional balance, and mental clarity.</p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <ul class="list-unstyled">
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Flexbility & Posture
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Core Strength
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled">
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Stress Reduction
                                    </li>
                                    <li class="mb-3 d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i> Better Breathing
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="#plans" class="btn btn-outline-primary rounded-pill px-4 mt-3">View Yoga Plans</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. DIET BENEFITS -->
    <section id="diet" class="py-5 bg-white">
        <div class="container py-5">
            <div class="row align-items-center flex-lg-row-reverse">
                <div class="col-lg-6 mb-4 mb-lg-0 position-relative text-center" data-aos="fade-left">
                     <!-- Decorative Blob -->
                    <div class="position-absolute bg-success rounded-circle opacity-10" style="width: 300px; height: 300px; bottom: -20px; right: -20px; z-index: 0;"></div>
                    <img src="{{ asset('image/diet.png') }}" class="img-fluid position-relative rounded-4 shadow-lg" style="z-index: 1;" alt="Diet Illustration">
                </div>
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="pe-lg-5">
                        <h6 class="text-success fw-bold text-uppercase mb-2">Eat Smart</h6>
                        <h2 class="fw-bold mb-4 display-6">Nurse Your Body With <span class="text-success">Personalized Diets</span></h2>
                        <p class="lead text-muted mb-4">Sustainable results come from aligning your food choices with your lifestyle. No starving, just smart eating.</p>

                        <div class="accordion accordion-flush" id="dietAccordion">
                            <div class="accordion-item border-0 mb-3 bg-light rounded-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                        <i class="bi bi-heart-pulse text-danger me-2"></i> Weight Management
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#dietAccordion">
                                    <div class="accordion-body text-muted small pt-0">
                                        Scientific approaches to gaining or losing weight in a healthy, maintainable way.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3 bg-light rounded-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                                        <i class="bi bi-droplet text-info me-2"></i> Metabolism & Digestion
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#dietAccordion">
                                    <div class="accordion-body text-muted small pt-0">
                                        Improve gut health and boost energy levels naturally through better food choices.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 mb-3 bg-light rounded-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree">
                                        <i class="bi bi-flower1 text-warning me-2"></i> Healing & Management
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#dietAccordion">
                                    <div class="accordion-body text-muted small pt-0">
                                        Specialized plans for PCOS, Diabetes, Thyroid, and other lifestyle conditions.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. TESTIMONIALS -->
    <section id="testimonials" class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #eef2f6 100%); position: relative; overflow: hidden;">
         <!-- Background Pattern -->
         <div class="position-absolute top-0 start-0 w-100 h-100 opacity-5" style="background-image: radial-gradient(#667eea 1px, transparent 1px); background-size: 20px 20px;"></div>
         
        <div class="container py-5 position-relative">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Happy Clients</h2>
                <p class="text-muted mt-3">Don't just take our word for it.</p>
            </div>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators mb-0" style="bottom: -40px;">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active bg-secondary"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" class="bg-secondary"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" class="bg-secondary"></button>
                </div>

                <div class="carousel-inner pb-5"> <!-- pb-5 for indicators spacing -->
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial-card shadow-lg text-center bg-white p-5 rounded-4 position-relative mx-3">
                                    <i class="bi bi-quote quote-icon text-primary opacity-10 display-1 position-absolute top-0 start-0 ms-4 mt-3"></i>
                                    
                                    <div class="d-flex justify-content-center mb-4 position-relative">
                                         <div class="p-1 bg-white rounded-circle shadow-sm">
                                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle" width="100" height="100" alt="Client">
                                         </div>
                                    </div>
                                    
                                    <p class="fs-4 fst-italic text-dark mb-4" style="line-height: 1.6;">"I lost 7kg in just 2 months with her customized diet guidance. Very simple, easy to follow and super effective!"</p>
                                    
                                    <h5 class="fw-bold mb-1 text-primary">Neha Sharma</h5>
                                    <span class="d-block text-muted small mb-3">Diet Plan Client</span>
                                    
                                    <div class="text-warning">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial-card shadow-lg text-center bg-white p-5 rounded-4 position-relative mx-3">
                                    <i class="bi bi-quote quote-icon text-success opacity-10 display-1 position-absolute top-0 start-0 ms-4 mt-3"></i>
                                    
                                    <div class="d-flex justify-content-center mb-4 position-relative">
                                        <div class="p-1 bg-white rounded-circle shadow-sm">
                                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle" width="100" height="100" alt="Client">
                                        </div>
                                    </div>
                                    
                                    <p class="fs-4 fst-italic text-dark mb-4" style="line-height: 1.6;">"My flexibility improved drastically, stress reduced and breathing got better. The sessions are very calming and effective!"</p>
                                    
                                    <h5 class="fw-bold mb-1 text-success">Raj Verma</h5>
                                    <span class="d-block text-muted small mb-3">Yoga Student</span>
                                    
                                    <div class="text-warning">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Slide 3 (New) -->
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="testimonial-card shadow-lg text-center bg-white p-5 rounded-4 position-relative mx-3">
                                    <i class="bi bi-quote quote-icon text-warning opacity-10 display-1 position-absolute top-0 start-0 ms-4 mt-3"></i>
                                    
                                    <div class="d-flex justify-content-center mb-4 position-relative">
                                         <div class="p-1 bg-white rounded-circle shadow-sm">
                                            <img src="https://randomuser.me/api/portraits/women/65.jpg" class="rounded-circle" width="100" height="100" alt="Client">
                                         </div>
                                    </div>
                                    
                                    <p class="fs-4 fst-italic text-dark mb-4" style="line-height: 1.6;">"I feel more energetic and lighter throughout the day. The combination of Yoga and Diet is a game changer!"</p>
                                    
                                    <h5 class="fw-bold mb-1 text-warning">Priya Singh</h5>
                                    <span class="d-block text-muted small mb-3">Combo Plan Client</span>
                                    
                                    <div class="text-warning">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" style="width: 5%;">
                    <span class="carousel-control-prev-icon bg-primary rounded-circle p-2" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" style="width: 5%;">
                    <span class="carousel-control-next-icon bg-primary rounded-circle p-2" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

    <!-- 6. PRICING PLANS -->
    <section id="plans" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Our Wellness Plans</h2>
                <p class="text-muted mt-3">Invest in your health with our transparent pricing packages.</p>
            </div>

            @php
                $typeLabels = [
                    'yoga' => ['title' => 'Yoga Plans', 'color' => 'primary', 'icon' => 'bi-person-walking'],
                    'diet' => ['title' => 'Diet Plans', 'color' => 'success', 'icon' => 'bi-egg-fried'],
                    'combo' => ['title' => 'Combo Plans', 'color' => 'warning', 'icon' => 'bi-stars'],
                    'personal' => ['title' => 'Personal Training', 'color' => 'danger', 'icon' => 'bi-person-heart'],
                ];
            @endphp

            @foreach ($plans as $type => $typePlans)
                @php $label = $typeLabels[$type] ?? ['title' => ucfirst($type), 'color' => 'secondary', 'icon' => 'bi-patch-check']; @endphp
                
                <div class="mb-5" data-aos="fade-up">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-2">
                        <div class="bg-{{ $label['color'] }} bg-opacity-10 p-2 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi {{ $label['icon'] }} text-{{ $label['color'] }} fs-4"></i>
                        </div>
                        <h3 class="h4 mb-0 fw-bold">{{ $label['title'] }}</h3>
                    </div>

                    <div class="row g-4 justify-content-start">
                        @foreach ($typePlans as $plan)
                            <div class="col-md-6 col-lg-4">
                                <div class="card pricing-card h-100 shadow-sm position-relative border-0" style="border-top: 5px solid {{ $plan->color }} !important;">
                                    @if($plan->discount_type && $plan->discount_value > 0)
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-danger rounded-pill shadow-sm">
                                                @if($plan->discount_type === 'percentage')
                                                    {{ round($plan->discount_value) }}% OFF
                                                @else
                                                    ₹{{ round($plan->discount_value) }} OFF
                                                @endif
                                            </span>
                                        </div>
                                    @endif

                                    @if(strtolower($type) == 'combo' || $loop->first && $type == 'yoga')
                                        <div class="popular-badge">BEST VALUE</div>
                                    @endif
                                    
                                    <div class="card-body p-4 text-center d-flex flex-column">
                                        <h5 class="fw-bold text-uppercase text-muted small mb-3">{{ $plan->name }}</h5>
                                        
                                        <div class="mb-4">
                                            @if($plan->discount_type && $plan->discount_value > 0)
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <del class="text-muted h4 mb-0">₹{{ number_format($plan->price) }}</del>
                                                    <h2 class="display-5 fw-bold text-dark mb-0">₹{{ number_format($plan->discounted_price) }}</h2>
                                                </div>
                                            @else
                                                <h2 class="display-5 fw-bold text-dark mb-0">₹{{ number_format($plan->price) }}</h2>
                                            @endif
                                            <p class="text-muted small mb-0">{{ $plan->interval_days }} Days Validity</p>
                                            @if($plan->trial_days > 0)
                                                <p class="text-success small fw-bold mb-0">Incl. {{ $plan->trial_days }} Days Free Trial</p>
                                            @endif
                                        </div>

                                        <ul class="list-unstyled text-start mb-4 mx-auto">
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Personalized Approach</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Weekly Check-ins</li>
                                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> WhatsApp Support</li>
                                            @if($plan->description)
                                                <li class="mb-2"><i class="bi bi-info-circle-fill text-primary me-2"></i> <span class="small">{{ Str::limit($plan->description, 50) }}</span></li>
                                            @endif
                                        </ul>

                                        <div class="mt-auto">
                                            <a href="{{ route('subscription.checkout', $plan->uuid) }}" 
                                               class="btn btn-outline-{{ $label['color'] }} w-100 py-2 rounded-pill fw-bold shadow-sm transition-all border-2">
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- 7. CONTACT US -->
    <section id="contact" class="py-5" style="background: #f8fafc;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="contact-box shadow-lg">
                        <div class="row g-0">
                            <!-- Contact Info -->
                            <div class="col-lg-5 bg-dark text-white p-5 d-flex flex-column justify-content-between">
                                <div>
                                    <h3 class="fw-bold mb-4">Get in Touch</h3>
                                    <p class="text-white-50 mb-4">Have questions about our plans? Feel free to reach out. We're here to help you start your journey.</p>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                            <i class="bi bi-envelope-fill"></i>
                                        </div>
                                        <span>contact@yogakavi.com</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                            <i class="bi bi-telephone-fill"></i>
                                        </div>
                                        <span>+91 96969 69696</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <span>Kanpur, Uttar Pradesh</span>
                                    </div>
                                </div>
                                
                                <div class="mt-5">
                                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                                    <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-5"></i></a>
                                    <a href="#" class="text-white"><i class="bi bi-twitter fs-5"></i></a>
                                </div>
                            </div>
                            <!-- Contact Form -->
                            <div class="col-lg-7 p-5 bg-white">
                                <h3 class="fw-bold mb-4 text-dark">Send us a Message</h3>
                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-light border-0" id="name" name="name" placeholder="Your Name" required>
                                                <label for="name">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control bg-light border-0" id="email" name="email" placeholder="Your Email" required>
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-light border-0" id="subject" name="subject" placeholder="Subject" required>
                                                <label for="subject">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control bg-light border-0" placeholder="Leave a message here" id="message" name="message" style="height: 150px" required></textarea>
                                                <label for="message">Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script type="module">

    </script>
@endsection
