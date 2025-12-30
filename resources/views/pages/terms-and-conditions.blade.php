@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">Terms and Conditions</h1>
                    <p class="text-muted mb-5">Last updated: {{ date('F d, Y') }}</p>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">1. Acceptance of Terms</h4>
                        <p>By accessing and using Yoga Kaavi, you agree to comply with and be bound by these Terms and Conditions. If you do not agree, please refrain from using our services.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">2. Description of Service</h4>
                        <p>Yoga Kaavi provides personalized yoga and diet plans based on user-provided data. These plans are for informational purposes and do not constitute medical advice.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">3. User Responsibilities</h4>
                        <p>You are responsible for providing accurate information in your intake forms. You should consult with a healthcare professional before starting any new fitness or diet program, especially if you have pre-existing health conditions.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">4. Payments and Subscriptions</h4>
                        <p>Certain services require a paid subscription. All fees are non-refundable unless otherwise specified. We use Razorpay for secure payment processing.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">5. Intellectual Property</h4>
                        <p>All content on Yoga Kaavi, including text, graphics, and logos, is the property of Yoga Kaavi and protected by intellectual property laws.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">6. Limitation of Liability</h4>
                        <p>Yoga Kaavi shall not be liable for any indirect, incidental, or consequential damages arising from your use of our services.</p>
                    </section>

                    <section>
                        <h4 class="fw-bold mb-3">7. Changes to Terms</h4>
                        <p>We reserve the right to modify these Terms and Conditions at any time. Your continued use of the service constitutes acceptance of the updated terms.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
