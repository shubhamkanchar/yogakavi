@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">Privacy Policy</h1>
                    <p class="text-muted mb-5">Last updated: {{ date('F d, Y') }}</p>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">1. Information We Collect</h4>
                        <p>We collect information that you provide directly to us, such as when you create an account, fill out an intake form, or contact us for support. This may include:</p>
                        <ul>
                            <li>Name and contact information</li>
                            <li>Health and fitness data provided in intake forms</li>
                            <li>Payment information (processed by our payment provider)</li>
                            <li>Communication history</li>
                        </ul>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">2. How We Use Your Information</h4>
                        <p>We use the collected information to:</p>
                        <ul>
                            <li>Provide and maintain our services</li>
                            <li>Personalize your experience (e.g., diet and yoga plans)</li>
                            <li>Process your transactions</li>
                            <li>Communicate with you about updates or support</li>
                            <li>Improve our website and services</li>
                        </ul>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">3. Information Sharing</h4>
                        <p>We do not sell your personal information. We may share information with service providers who perform services on our behalf, such as payment processing or email delivery, subject to confidentiality agreements.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">4. Data Security</h4>
                        <p>We implement reasonable security measures to protect your information from unauthorized access, disclosure, or destruction. However, no method of transmission over the internet is 100% secure.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">5. Your Choices</h4>
                        <p>You can access and update your account information at any time. You may also contact us to request the deletion of your personal data, subject to legal or contractual obligations.</p>
                    </section>

                    <section>
                        <h4 class="fw-bold mb-3">6. Contact Us</h4>
                        <p>If you have any questions about this Privacy Policy, please contact us at support@yogakaavi.com.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
