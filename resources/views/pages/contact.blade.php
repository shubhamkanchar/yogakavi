@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="bg-white shadow-sm rounded-4 overflow-hidden border-0">
                <div class="row g-0">
                    <div class="col-md-5 bg-primary text-white p-4 p-md-5 d-flex flex-column justify-content-center">
                        <h2 class="fw-bold mb-4">Get in Touch</h2>
                        <p class="mb-5 opacity-75">Have questions about our yoga or diet plans? We're here to help you on your wellness journey.</p>
                        
                        <div class="d-flex mb-4">
                            <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Location</h6>
                                <p class="mb-0 opacity-75">Bengaluru, Karnataka, India</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Email</h6>
                                <p class="mb-0 opacity-75">hello@yogakaavi.com</p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Phone</h6>
                                <p class="mb-0 opacity-75">+91 98765 43210</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-7 p-4 p-md-5">
                        <h3 class="fw-bold mb-4 text-dark">Send us a Message</h3>
                        
                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Your Name</label>
                                <input type="text" class="form-control bg-light border-0 py-3 px-4 @error('name') is-invalid @enderror" id="name" name="name" placeholder="John Doe" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">Email Address</label>
                                <input type="email" class="form-control bg-light border-0 py-3 px-4 @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label fw-medium">Subject</label>
                                <input type="text" class="form-control bg-light border-0 py-3 px-4 @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Plan Inquiry" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label fw-medium">Your Message</label>
                                <textarea class="form-control bg-light border-0 py-3 px-4 @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="How can we help you?" required></textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 fw-bold shadow-sm">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<style>
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.25 cold-primary-light;
        border: 1px solid var(--bs-primary) !important;
    }
    .bg-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
    }
</style>
@endsection
