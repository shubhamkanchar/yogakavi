<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mind & Body Wellness – Diet & Yoga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            scroll-behavior: smooth;
        }

        /* HERO */
        .hero-area {
            padding: 130px 0 120px;
            background: linear-gradient(120deg, #66e6c7, #ffafbd);
            color: #fff;
            border-bottom-left-radius: 60px;
            border-bottom-right-radius: 60px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .glass-box {
            background: rgba(255,255,255,0.25);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 20px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .btn-main {
            background: linear-gradient(45deg, #ff6f91, #ff9671);
            border: none;
            color: #fff;
            padding: 12px 28px;
            border-radius: 50px;
            font-size: 17px;
        }

        .section-title {
            font-weight: 800;
            color: #ff6f91;
        }

        /* SERVICE BOX */
        .service-card {
            background: white;
            padding: 25px;
            border-radius: 25px;
            text-align: center;
            transition: .3s;
            border-bottom: 5px solid transparent;
        }
        .service-card:hover {
            transform: translateY(-10px);
            border-bottom: 5px solid #ff6f91;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        /* PRICING */
        .price-box {
            padding: 30px;
            border-radius: 30px;
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            box-shadow: 10px 10px 20px #cfcfcf, -10px -10px 20px #ffffff;
            text-align: center;
            transition: .3s;
        }
        .price-box:hover {
            transform: scale(1.04);
        }

        /* CONTACT */
        .contact-box {
            background: #fff;
            padding: 35px;
            border-radius: 25px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3 text-success" href="#">Mind & Body</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto fw-semibold">
                <li class="nav-item px-2"><a href="#home" class="nav-link">Home</a></li>
                <li class="nav-item px-2"><a href="#services" class="nav-link">Services</a></li>
                <li class="nav-item px-2"><a href="#programs" class="nav-link">Programs</a></li>
                <li class="nav-item px-2"><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
            <a href="#contact" class="btn btn-main ms-3">Join Us</a>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero-area text-center" id="home">
    <div class="container">
        <h1 class="fw-bold display-4" data-aos="fade-up">
            Balanced Life with <span class="fw-bold text-dark">Diet & Yoga</span>
        </h1>
        <p class="mt-4 fs-5" data-aos="fade-up" data-aos-delay="200">
            Achieve your fitness goals through personalised diet guidance and daily yoga.
        </p>

        <div class="d-flex justify-content-center mt-4">
            <div class="glass-box d-flex gap-4">
                <div><i class="bi bi-heart-pulse fs-3"></i><p>Health</p></div>
                <div><i class="bi bi-flower2 fs-3"></i><p>Yoga</p></div>
                <div><i class="bi bi-nutrition fs-3"></i><p>Diet</p></div>
            </div>
        </div>

        <a href="#services" class="btn btn-light btn-lg mt-4 shadow">Explore Services</a>
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
        <h2 class="text-center section-title mb-5">What We Offer</h2>

        <div class="row g-4">
            <div class="col-lg-4" data-aos="zoom-in">
                <div class="service-card shadow-sm">
                    <i class="bi bi-egg-fried fs-1 text-warning"></i>
                    <h4 class="mt-3 fw-bold">Diet Consultation</h4>
                    <p>Personalised weekly diet plans to match your body’s needs.</p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="service-card shadow-sm">
                    <i class="bi bi-peace fs-1 text-success"></i>
                    <h4 class="mt-3 fw-bold">Yoga Classes</h4>
                    <p>Online & offline yoga sessions for strength, flexibility and healing.</p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="service-card shadow-sm">
                    <i class="bi bi-phone-flip fs-1 text-primary"></i>
                    <h4 class="mt-3 fw-bold">Digital Wellness</h4>
                    <p>Progress tracking, diet generator tool, and weekly follow-ups.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAMS / PRICING -->
<section class="py-5" id="programs">
    <div class="container">
        <h2 class="text-center section-title mb-5">Our Programs</h2>

        <div class="row g-4 justify-content-center">

            <div class="col-md-4" data-aos="fade-up">
                <div class="price-box">
                    <h4 class="fw-bold">Starter Wellness</h4>
                    <h2 class="text-success fw-bold mt-3">₹899</h2>
                    <ul class="list-unstyled mt-3">
                        <li>✓ 1 Diet Chart</li>
                        <li>✓ 4 Yoga Classes</li>
                        <li>✓ Chat Support</li>
                    </ul>
                    <a href="#" class="btn btn-main mt-3">Get Started</a>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                <div class="price-box">
                    <h4 class="fw-bold">Transformation Plan</h4>
                    <h2 class="text-success fw-bold mt-3">₹2499</h2>
                    <ul class="list-unstyled mt-3">
                        <li>✓ Weekly Diet Plan</li>
                        <li>✓ Unlimited Yoga</li>
                        <li>✓ Personal Coach</li>
                    </ul>
                    <a href="#" class="btn btn-main mt-3">Join Now</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="py-5" id="contact">
    <div class="container">
        <h2 class="text-center section-title mb-5">Get in Touch</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="contact-box">
                    <input type="text" class="form-control mb-3" placeholder="Your Name">
                    <input type="email" class="form-control mb-3" placeholder="Your Email">
                    <input type="text" class="form-control mb-3" placeholder="Phone">
                    <textarea class="form-control mb-3" rows="4" placeholder="Your Message"></textarea>
                    <button class="btn btn-main w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="py-3 bg-dark text-center text-white">
    © 2025 Mind & Body Wellness – All Rights Reserved
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init();</script>

</body>
</html>
