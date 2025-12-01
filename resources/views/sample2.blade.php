<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Studio – Diet & Yoga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Animation (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body { scroll-behavior: smooth; }
        .hero-section {
            background: linear-gradient(135deg, #ffbb33, #ff4081);
            color: white;
            padding: 100px 0;
            clip-path: ellipse(120% 90% at 50% 10%);
        }
        .section-title {
            font-weight: 800;
            color: #ff4081;
        }
        .highlight {
            background: #ffe6f0;
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 600;
        }
        .feature-box {
            background: white;
            border-radius: 20px;
            padding: 30px;
            transition: .3s;
            border: 3px solid transparent;
        }
        .feature-box:hover {
            transform: translateY(-10px);
            border-color: #ff4081;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-gradient {
            background: linear-gradient(45deg, #ff4081, #ffbb33);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 18px;
        }
        .pricing-card {
            border-radius: 25px;
            background: #fff7e6;
            border: 2px solid #ffbb33;
            transition: .3s;
        }
        .pricing-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(255,193,7,0.4);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger fs-3" href="#">Wellness Studio</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto fw-semibold">
                <li class="nav-item px-2"><a href="#home" class="nav-link">Home</a></li>
                <li class="nav-item px-2"><a href="#services" class="nav-link">Services</a></li>
                <li class="nav-item px-2"><a href="#about" class="nav-link">About</a></li>
                <li class="nav-item px-2"><a href="#pricing" class="nav-link">Plans</a></li>
                <li class="nav-item px-2"><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
            <a href="#" class="btn btn-gradient ms-3">Join Now</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section text-center" id="home">
    <div class="container">
        <h1 class="fw-bold display-4" data-aos="fade-up">
            Transform Your <span class="highlight">Body & Mind</span> with Diet & Yoga
        </h1>
        <p class="mt-4 fs-5" data-aos="fade-up" data-aos-delay="200">
            Personalised diet plans • Daily yoga batches • Weight loss program • Wellness coaching
        </p>
        <a href="#contact" class="btn btn-light btn-lg mt-4 shadow" data-aos="zoom-in">
            Book Free Consultation
        </a>
    </div>
</section>

<!-- GALLERY -->
<section class="py-5" id="gallery" style="background:#fdf7fa;">
    <div class="container">
        <h2 class="text-center section-title mb-5">Our Wellness Gallery</h2>

        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <a href="https://picsum.photos/800/600?1" target="_blank">
                    <img src="https://picsum.photos/400/300?1" class="img-fluid rounded shadow">
                </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <a href="https://picsum.photos/800/600?2" target="_blank">
                    <img src="https://picsum.photos/400/300?2" class="img-fluid rounded shadow">
                </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <a href="https://picsum.photos/800/600?3" target="_blank">
                    <img src="https://picsum.photos/400/300?3" class="img-fluid rounded shadow">
                </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in">
                <a href="https://picsum.photos/800/600?4" target="_blank">
                    <img src="https://picsum.photos/400/300?4" class="img-fluid rounded shadow">
                </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <a href="https://picsum.photos/800/600?5" target="_blank">
                    <img src="https://picsum.photos/400/300?5" class="img-fluid rounded shadow">
                </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <a href="https://picsum.photos/800/600?6" target="_blank">
                    <img src="https://picsum.photos/400/300?6" class="img-fluid rounded shadow">
                </a>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-5" id="testimonials" style="background:#fff0f5;">
    <div class="container">
        <h2 class="text-center section-title mb-5">What Clients Say</h2>

        <div class="row g-4">

            <div class="col-md-4" data-aos="fade-up">
                <div class="p-4 bg-white rounded shadow-lg text-center" style="border-radius:25px;">
                    <img src="https://i.pravatar.cc/100?img=5" class="rounded-circle mb-3" width="90">
                    <p class="fw-semibold">“The personalised diet plan helped me lose 7 kg in 2 months!”</p>
                    <div class="text-warning fs-5">
                        ★★★★★
                    </div>
                    <h6 class="mt-2 fw-bold">— Sneha Patil</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                <div class="p-4 bg-white rounded shadow-lg text-center" style="border-radius:25px;">
                    <img src="https://i.pravatar.cc/100?img=12" class="rounded-circle mb-3" width="90">
                    <p class="fw-semibold">“Yoga classes are amazing. My back pain almost vanished!”</p>
                    <div class="text-warning fs-5">
                        ★★★★★
                    </div>
                    <h6 class="mt-2 fw-bold">— Rahul Sharma</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4 bg-white rounded shadow-lg text-center" style="border-radius:25px;">
                    <img src="https://i.pravatar.cc/100?img=22" class="rounded-circle mb-3" width="90">
                    <p class="fw-semibold">“The transformation program changed my lifestyle completely!”</p>
                    <div class="text-warning fs-5">
                        ★★★★★
                    </div>
                    <h6 class="mt-2 fw-bold">— Priya Mehta</h6>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="py-5" id="services">
    <div class="container">
        <h2 class="text-center section-title mb-5">Our Services</h2>

        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up">
                <div class="feature-box shadow-sm">
                    <i class="bi bi-heart-pulse fs-1 text-danger"></i>
                    <h4 class="mt-3 fw-bold">Personalised Diet Plans</h4>
                    <p>Custom diet plans based on your lifestyle, body type, and health goals.</p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                <div class="feature-box shadow-sm">
                    <i class="bi bi-flower2 fs-1 text-success"></i>
                    <h4 class="mt-3 fw-bold">Yoga Batches</h4>
                    <p>Group & personal yoga sessions for flexibility, strength, and mindfulness.</p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-box shadow-sm">
                    <i class="bi bi-cash-coin fs-1 text-warning"></i>
                    <h4 class="mt-3 fw-bold">Online Programs</h4>
                    <p>Join live Zoom yoga, online diet tracking & digital wellness consultation.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING -->
<section class="py-5" id="pricing" style="background:#fff0f5;">
    <div class="container">
        <h2 class="text-center section-title mb-5">Our Plans</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="pricing-card p-4 text-center shadow">
                    <h4 class="fw-bold">Basic Wellness</h4>
                    <h2 class="text-danger fw-bold mt-3">₹999</h2>
                    <ul class="list-unstyled mt-3">
                        <li>✓ 1 Diet Plan</li>
                        <li>✓ 4 Yoga Classes</li>
                        <li>✓ WhatsApp Support</li>
                    </ul>
                    <a href="#" class="btn btn-gradient mt-3">Start Now</a>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="pricing-card p-4 text-center shadow">
                    <h4 class="fw-bold">Premium Transformation</h4>
                    <h2 class="text-danger fw-bold mt-3">₹2999</h2>
                    <ul class="list-unstyled mt-3">
                        <li>✓ Weekly Diet Plan</li>
                        <li>✓ Unlimited Yoga</li>
                        <li>✓ Personal Coach</li>
                    </ul>
                    <a href="#" class="btn btn-gradient mt-3">Start Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="py-5" id="contact">
    <div class="container">
        <h2 class="text-center section-title mb-5">Contact Us</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="p-4 shadow-lg rounded bg-white">
                    <input type="text" class="form-control mb-3" placeholder="Full Name">
                    <input type="email" class="form-control mb-3" placeholder="Email">
                    <input type="text" class="form-control mb-3" placeholder="Phone">
                    <textarea class="form-control mb-3" rows="4" placeholder="Message"></textarea>
                    <button class="btn btn-gradient w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="py-3 bg-dark text-center text-white">
    © 2025 Wellness Studio – All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
