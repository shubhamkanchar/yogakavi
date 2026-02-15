@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Gallery Management</h2>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Add Image
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($images as $image)
                        <tr>
                            <td class="ps-4">
                                <img src="{{ asset('storage/' . $image->image) }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $image->title ?? 'No Title' }}</div>
                                <div class="small text-muted">{{ Str::limit($image->description, 50) }}</div>
                            </td>
                            <td>
                                @if($image->is_active)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Active</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $image->created_at->format('d M, Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('admin.gallery.toggle', $image->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                            {{ $image->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-images fs-1 d-block mb-3 opacity-25"></i>
                                No images found in the gallery.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
