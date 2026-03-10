@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Gallery Management</h2>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Add Media
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
                            <th class="ps-4">Media</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($images as $item)
                        <tr>
                            <td class="ps-4">
                                @if($item->type === 'video')
                                    <div class="bg-dark rounded shadow-sm d-flex align-items-center justify-content-center" style="width: 80px; height: 50px;">
                                        <i class="bi bi-play-circle text-white fs-4"></i>
                                    </div>
                                @else
                                    <img src="{{ $item->image_url }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">
                                    {{ $item->title ?? 'No Title' }}
                                    @if($item->type === 'image')
                                        <span class="badge bg-secondary ms-1" style="font-size: 0.65em;">Image</span>
                                    @elseif($item->type === 'video')
                                        <span class="badge bg-info text-dark ms-1" style="font-size: 0.65em;">Video</span>
                                    @elseif($item->type === 'youtube')
                                        <span class="badge bg-danger ms-1" style="font-size: 0.65em;">YouTube</span>
                                    @endif
                                </div>
                                <div class="small text-muted">{{ Str::limit($item->description, 50) }}</div>
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Active</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d M, Y') }}</td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <form action="{{ route('admin.gallery.toggle', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                            {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                                No media found in the gallery.
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
