@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4">Refund Policy</h1>
                    <p class="text-muted mb-5">Last updated: {{ date('F d, Y') }}</p>

                    <div class="alert alert-warning border-0 rounded-4 p-4 mb-5">
                        <div class="d-flex">
                            <i class="bi bi-exclamation-triangle-fill fs-3 me-3"></i>
                            <div>
                                <h5 class="fw-bold">Important Notice</h5>
                                <p class="mb-0">Please read our refund policy carefully before making a purchase. By subscribing to our services, you acknowledge and agree to the terms below.</p>
                            </div>
                        </div>
                    </div>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">No Refund Policy</h4>
                        <p class="fs-5 text-dark">We do not offer refunds for any of our services once a subscription has been purchased or a trial period has ended.</p>
                        <p>At Yoga Kaavi, we provide personalized digital content, including yoga routines and diet plans, which are delivered immediately upon subscription. Due to the digital nature of these services, all sales are final.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">Trial Period</h4>
                        <p>We offer a 7-day free trial on selected plans to allow you to experience our services before making a financial commitment. We encourage you to utilize the trial period to ensure our services meet your expectations. Once the trial period ends and your paid subscription begins, no refunds will be issued.</p>
                    </section>

                    <section class="mb-5">
                        <h4 class="fw-bold mb-3">Exceptions</h4>
                        <p>Refunds may only be considered in the case of technical errors where a payment was processed multiple times for the same service or in compliance with applicable local laws. If you believe such an error has occurred, please contact our support team with proof of transaction.</p>
                    </section>

                    <section>
                        <h4 class="fw-bold mb-3">Contact for Billing Support</h4>
                        <p>For any billing-related inquiries or to report a technical payment error, please reach out to us at billing@yogakaavi.com.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
