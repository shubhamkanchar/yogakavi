<footer class="bg-dark text-white pt-5 pb-3 mt-auto">
    <div class="container">
        <div class="row g-4">
            
            <!-- 1. Brand & Info -->
            <div class="col-lg-4 col-md-6">
                <h4 class="fw-bold text-white mb-3">
                    <i class="bi bi-heart-pulse-fill text-primary me-2"></i>{{ config('app.name', 'Yogakavi') }}
                </h4>
                <p class="text-white-50 small pe-lg-5">
                    Your partner in holistic wellness. We blend ancient yoga traditions with modern nutritional science to help you achieve a balanced, healthy life.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white-50 hover-text-white"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="bi bi-instagram fs-5"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="bi bi-youtube fs-5"></i></a>
                </div>
            </div>

            <!-- 2. Quick Links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="fw-bold mb-3 text-uppercase text-primary" style="font-size: 0.85rem; letter-spacing: 1px;">Discover</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><a href="{{ route('welcome') }}#home" class="text-reset text-decoration-none hover-text-white">Home</a></li>
                    <li class="mb-2"><a href="{{ route('welcome') }}#why-us" class="text-reset text-decoration-none hover-text-white">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('welcome') }}#plans" class="text-reset text-decoration-none hover-text-white">Pricing</a></li>
                    <li class="mb-2"><a href="{{ route('welcome') }}#testimonials" class="text-reset text-decoration-none hover-text-white">Success Stories</a></li>
                </ul>
            </div>

            <!-- 3. Programs -->
            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="fw-bold mb-3 text-uppercase text-primary" style="font-size: 0.85rem; letter-spacing: 1px;">Programs</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><a href="{{ route('welcome') }}#yoga" class="text-reset text-decoration-none hover-text-white">Yoga Batches</a></li>
                    <li class="mb-2"><a href="{{ route('welcome') }}#diet" class="text-reset text-decoration-none hover-text-white">Diet Plans</a></li>
                    <li class="mb-2"><a href="{{ route('welcome') }}#plans" class="text-reset text-decoration-none hover-text-white">Combo Plans</a></li>
                    <li class="mb-2"><a href="#" class="text-reset text-decoration-none hover-text-white">Corporate Wellness</a></li>
                </ul>
            </div>

            <!-- 4. Contact -->
            <div class="col-lg-4 col-md-6">
                 <h6 class="fw-bold mb-3 text-uppercase text-primary" style="font-size: 0.85rem; letter-spacing: 1px;">Contact Us</h6>
                 <ul class="list-unstyled text-white-50 small">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill me-2 mt-1 text-primary"></i>
                        <span>123 Wellness Street, Civil Lines, Kanpur, Uttar Pradesh, India</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2 text-primary"></i>
                        <span>contact@yogakavi.com</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-telephone-fill me-2 text-primary"></i>
                        <span>+91 96969 69696</span>
                    </li>
                 </ul>
            </div>
        </div>

        <hr class="border-secondary my-4 opacity-50">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-white-50 small">© {{ date('Y') }} {{ config('app.name', 'Yogakavi') }}. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <a href="#" class="text-white-50 small text-decoration-none me-3 hover-text-white">Privacy Policy</a>
                <a href="#" class="text-white-50 small text-decoration-none hover-text-white">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-text-white:hover {
        color: #fff !important;
        transition: color 0.2s;
    }
</style>