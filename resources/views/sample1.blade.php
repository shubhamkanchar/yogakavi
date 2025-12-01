<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness With Shubham – Diet & Yoga</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animation CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        /* Hero */
        .hero {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1554344056-0f2c5f5f6687?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            color: #fff;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Services */
        .service-box {
            padding: 30px;
            border-radius: 10px;
            background: #fff;
            transition: 0.3s;
        }

        .service-box:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }

        /* Testimonials */
        .testimonial {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
        }

        /* Footer */
        .footer {
            background: #111;
            color: #ddd;
            padding: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Wellness With Shubham</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container text-center hero-content" data-aos="fade-up">
            <h1 class="fw-bold display-4">Your Personal Dietician & Yoga Coach</h1>
            <p class="lead mt-3">Transform your body, mind, and lifestyle with personalised nutrition & guided yoga sessions.</p>
            <a href="#contact" class="btn btn-lg btn-success mt-3">Book Free Consultation</a>
        </div>
    </section>

    <!-- Services -->
    <section class="py-5" id="services">
        <div class="container">
            <h2 class="text-center fw-bold mb-4" data-aos="fade-up">My Services</h2>
            <div class="row g-4">

                <div class="col-md-4" data-aos="fade-right">
                    <div class="service-box shadow-sm">
                        <h4>Personalised Diet Plans</h4>
                        <p>Customised weekly diet chart based on your goals — weight loss, gain, PCOS, thyroid & more.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up">
                    <div class="service-box shadow-sm">
                        <h4>Yoga Batches</h4>
                        <p>Live online/offline yoga sessions for flexibility, strength, stress relief & overall wellness.</p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-left">
                    <div class="service-box shadow-sm">
                        <h4>Fitness Monitoring</h4>
                        <p>Weekly check-ins, progress tracking & constant support through WhatsApp.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- About -->
    <section class="py-5 bg-light" id="about">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-6" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?auto=format&fit=crop&w=800&q=80"
                        class="img-fluid rounded shadow">
                </div>

                <div class="col-md-6" data-aos="fade-left">
                    <h2 class="fw-bold">About Me</h2>
                    <p>I am a certified dietician & yoga coach helping people achieve a healthier lifestyle through balanced eating & mindful movement.</p>
                    <p>With 1000+ happy clients, my focus is on *personalised guidance* that fits into your daily routine.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="py-5" id="pricing">
        <div class="container">
            <h2 class="text-center fw-bold mb-4" data-aos="fade-up">Pricing Plans</h2>

            <div class="row g-4">

                <div class="col-md-4" data-aos="zoom-in">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h4>Diet Plan – Monthly</h4>
                            <h2 class="text-success">₹999</h2>
                            <p>Weekly diet chart + follow-up</p>
                            <a href="#contact" class="btn btn-outline-success">Choose Plan</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="zoom-in">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h4>Yoga Batch – Monthly</h4>
                            <h2 class="text-success">₹1299</h2>
                            <p>Daily live yoga classes</p>
                            <a href="#contact" class="btn btn-outline-success">Join Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="zoom-in">
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h4>Combo Plan</h4>
                            <h2 class="text-success">₹1999</h2>
                            <p>Diet + Yoga with full support</p>
                            <a href="#contact" class="btn btn-success">Best Value</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Contact -->
    <section class="py-5 bg-light" id="contact">
        <div class="container">
            <h2 class="text-center fw-bold mb-4" data-aos="fade-up">Contact Me</h2>

            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">

                    <form class="p-4 bg-white shadow rounded">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="4" required></textarea>
                        </div>

                        <button class="btn btn-success w-100">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <p>© 2025 Wellness With Shubham. All Rights Reserved.</p>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
