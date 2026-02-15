
@extends('layouts.app')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Our Latest Blogs</h1>
            <p class="text-muted">Stay updated with our latest news and articles.</p>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-card">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark">
                        @if($blog->image)
                            <img src="{{ Storage::url($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="mb-2">
                                <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ $blog->created_at->format('M d, Y') }}</small>
                            </div>
                            <h5 class="card-title fw-bold mb-3">{{ Str::limit($blog->title, 60) }}</h5>
                            <p class="card-text text-muted small">
                                {!! Str::limit(strip_tags($blog->content), 100) !!}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 p-4 pt-0">
                            <span class="text-primary fw-bold small">Read More <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted">
                    <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
                    <h4>No blogs found.</h4>
                    <p>Check back later for updates!</p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </div>
</section>

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1)!important;
    }
</style>
@endsection
