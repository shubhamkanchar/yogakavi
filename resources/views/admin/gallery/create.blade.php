@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none text-muted small fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Back to Gallery
        </a>
        <h2 class="fw-bold mt-2">Add New Image</h2>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold h6">Select Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text small text-muted mt-1">Recommended: JPG, PNG (Max 2MB)</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold h6">Title (Optional)</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter image title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold h6">Description (Optional)</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Briefly describe this image">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm py-3">
                                <i class="bi bi-cloud-arrow-up me-2"></i> Upload Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 bg-light-subtle rounded-4 p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-lightbulb me-2 text-warning"></i> Tips</h5>
                <ul class="small text-muted mb-0">
                    <li class="mb-2">Ensure high-quality images for a better user experience.</li>
                    <li class="mb-2">Titles and descriptions are optional but help with SEO.</li>
                    <li>Always optimize image size before uploading to maintain fast page loads.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
