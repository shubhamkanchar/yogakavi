@extends('layouts.app')
@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 80vh;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold display-4 mb-3">Our Work & <span class="text-primary">Gallery</span></h1>
            <p class="text-muted lead mx-auto" style="max-width: 700px;">
                Explore moments from our yoga sessions, diet transformations, and the vibrant life at YogaKavi.
            </p>
        </div>

        <div class="row g-4" id="gallery-grid">
            @forelse($images as $image)
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden gallery-card h-100">
                    <div class="gallery-img-container position-relative">
                        <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top" alt="{{ $image->title }}" style="height: 250px; object-fit: cover; transition: transform 0.5s ease;">
                        <div class="gallery-overlay d-flex align-items-center justify-content-center">
                            <a href="{{ asset('storage/' . $image->image) }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" data-lightbox="gallery" data-title="{{ $image->title }}">
                                <i class="bi bi-zoom-in me-2"></i> View Large
                            </a>
                        </div>
                    </div>
                    @if($image->title || $image->description)
                    <div class="card-body p-4 bg-white">
                        @if($image->title)
                            <h5 class="fw-bold text-dark mb-2">{{ $image->title }}</h5>
                        @endif
                        @if($image->description)
                            <p class="small text-muted mb-0">{{ Str::limit($image->description, 100) }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="display-1 text-muted opacity-25 mb-4">
                    <i class="bi bi-images"></i>
                </div>
                <h3 class="fw-bold text-muted">No images to show yet</h3>
                <p class="text-muted">Check back soon for updates!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .gallery-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .gallery-card:hover img {
        transform: scale(1.1);
    }
    .gallery-img-container {
        overflow: hidden;
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
</style>

<!-- Add Lightbox CSS/JS if not already present -->
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'alwaysShowNavOnTouchDevices': true
    })
</script>
@endpush
@endsection
