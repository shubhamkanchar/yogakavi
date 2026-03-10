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
            @forelse($images as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden gallery-card h-100">
                    <div class="gallery-img-container position-relative" style="cursor: pointer;">
                        @if($item->type === 'video')
                            <div class="bg-dark d-flex align-items-center justify-content-center" style="height: 250px;">
                                <i class="bi bi-play-circle text-white opacity-50" style="font-size: 4rem;"></i>
                            </div>
                            <div class="gallery-overlay d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#mediaModal" onclick="setupMediaModal('video', '{{ asset(str_replace('\\', '/', $item->image)) }}', '{{ addslashes($item->title) }}')">
                                <span class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">
                                    <i class="bi bi-play-fill me-2"></i> Play Video
                                </span>
                            </div>
                        @elseif($item->type === 'youtube')
                            @php
                                // Extract YouTube video ID
                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $item->youtube_link, $match);
                                $videoId = $match[1] ?? null;
                            @endphp
                            <div class="position-relative">
                                <img src="{{ $item->image_url }}" class="card-img-top w-100" alt="{{ $item->title ?? 'Gallery Media' }}" style="height: 250px; object-fit: cover;">
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class="bi bi-youtube text-danger opacity-75" style="font-size: 4rem; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));"></i>
                                </div>
                            </div>
                            <div class="gallery-overlay d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#mediaModal" onclick="setupMediaModal('youtube', '{{ $videoId }}', '{{ addslashes($item->title) }}')">
                                <span class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm text-white">
                                    <i class="bi bi-play-fill me-2"></i> Play Video
                                </span>
                            </div>
                        @else
                            <img src="{{ $item->image_url }}" class="card-img-top w-100" alt="{{ $item->title ?? 'Gallery Media' }}" style="height: 250px; object-fit: cover; transition: transform 0.5s ease;">
                            <div class="gallery-overlay d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#mediaModal" onclick="setupMediaModal('image', '{{ asset(str_replace('\\', '/', $item->image)) }}', '{{ addslashes($item->title) }}')">
                                <span class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">
                                    <i class="bi bi-zoom-in me-2"></i> View Large
                                </span>
                            </div>
                        @endif
                    </div>
                    @if($item->title || $item->description)
                    <div class="card-body p-4 bg-white">
                        @if($item->title)
                            <h5 class="fw-bold text-dark mb-2">{{ $item->title }}</h5>
                        @endif
                        @if($item->description)
                            <p class="small text-muted mb-0">{{ Str::limit($item->description, 100) }}</p>
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
                <h3 class="fw-bold text-muted">No media to show yet</h3>
                <p class="text-muted">Check back soon for updates!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Media Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0 pb-0 justify-content-between p-3" style="position: absolute; top: -50px; right: 0; width: 100%; z-index: 10;">
                <h5 class="modal-title text-white fw-bold text-shadow" id="mediaModalTitle"></h5>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close" onclick="stopMedia()"></button>
            </div>
            <div class="modal-body p-0 rounded-4 overflow-hidden bg-black shadow-lg" id="mediaModalBody">
                <!-- Content injected via JS -->
            </div>
        </div>
    </div>
</div>

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
    .text-shadow {
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }
</style>



<script>
    // Hook into modal close to stop media playing
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('mediaModal');
        if(modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function () {
                stopMedia();
            });
        }
    });

    function setupMediaModal(type, source, title) {
        const body = document.getElementById('mediaModalBody');
        document.getElementById('mediaModalTitle').innerText = title || '';
        
        if (type === 'youtube') {
            body.innerHTML = `
                <div class="ratio ratio-16x9 border-0">
                    <iframe src="https://www.youtube.com/embed/${source}?autoplay=1&rel=0" class="border-0 rounded" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            `;
        } else if (type === 'video') {
            body.innerHTML = `
                <div class="ratio ratio-16x9 bg-dark border-0 rounded">
                    <video controls autoplay class="w-100 h-100 object-fit-contain rounded">
                        <source src="${source}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            `;
        } else if (type === 'image') {
            body.innerHTML = `
                <img src="${source}" class="img-fluid w-100 rounded" alt="Gallery Image">
            `;
        }
    }

    function stopMedia() {
        const body = document.getElementById('mediaModalBody');
        if (body) {
            body.innerHTML = ''; // Clears iframe/video to stop playing immediately
        }
    }
</script>
@endsection
