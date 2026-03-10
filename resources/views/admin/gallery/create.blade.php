@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none text-muted small fw-bold">
            <i class="bi bi-arrow-left me-1"></i> Back to Gallery
        </a>
        <h2 class="fw-bold mt-2">Add New Media</h2>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold h6">Media Type <span class="text-danger">*</span></label>
                            <select name="type" id="mediaType" class="form-select @error('type') is-invalid @enderror" required onchange="toggleFields()">
                                <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Image</option>
                                <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video (MP4, MOV)</option>
                                <option value="youtube" {{ old('type') == 'youtube' ? 'selected' : '' }}>YouTube Link</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4" id="uploadField">
                            <label class="form-label fw-bold h6" id="uploadLabel">Select Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text small text-muted mt-1" id="uploadHelp">Recommended: JPG, PNG (Max 2MB)</div>
                        </div>

                        <div class="mb-4 d-none" id="youtubeField">
                            <label class="form-label fw-bold h6">YouTube Link <span class="text-danger">*</span></label>
                            <input type="url" name="youtube_link" id="youtubeInput" class="form-control @error('youtube_link') is-invalid @enderror" value="{{ old('youtube_link') }}" placeholder="https://www.youtube.com/watch?v=...">
                            @error('youtube_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold h6">Title (Optional)</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter media title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold h6">Description (Optional)</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Briefly describe this media">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm py-3">
                                <i class="bi bi-cloud-arrow-up me-2"></i> Upload Media
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
                    <li class="mb-2">Ensure high-quality media for a better user experience.</li>
                    <li class="mb-2">Videos should be short and compressed if uploaded directly.</li>
                    <li class="mb-2">Connecting a YouTube link is recommended for large videos to save server bandwidth.</li>
                    <li class="mb-2">Titles and descriptions are optional but help with SEO.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        const type = document.getElementById('mediaType').value;
        const uploadField = document.getElementById('uploadField');
        const youtubeField = document.getElementById('youtubeField');
        const uploadLabel = document.getElementById('uploadLabel');
        const uploadHelp = document.getElementById('uploadHelp');
        const imageInput = document.getElementById('imageInput');
        const youtubeInput = document.getElementById('youtubeInput');

        if (type === 'youtube') {
            uploadField.classList.add('d-none');
            youtubeField.classList.remove('d-none');
            imageInput.removeAttribute('required');
            imageInput.value = '';
            youtubeInput.setAttribute('required', 'required');
        } else {
            uploadField.classList.remove('d-none');
            youtubeField.classList.add('d-none');
            youtubeInput.removeAttribute('required');
            youtubeInput.value = '';
            
            // Only make file upload required if it's not a youtube link and they haven't uploaded yet (handled by server validation mostly, but good for HTML5)
            // But we can just enforce HTML5 require on initial create
            imageInput.setAttribute('required', 'required');
            
            if (type === 'video') {
                uploadLabel.innerHTML = 'Select Video <span class="text-danger">*</span>';
                uploadHelp.innerHTML = 'Supported: MP4, MOV (Max 20MB)';
            } else {
                uploadLabel.innerHTML = 'Select Image <span class="text-danger">*</span>';
                uploadHelp.innerHTML = 'Recommended: JPG, PNG (Max 2MB)';
            }
        }
    }
    
    // Run on load in case of validation back with old input
    document.addEventListener("DOMContentLoaded", function() {
        toggleFields();
    });
</script>
@endsection
