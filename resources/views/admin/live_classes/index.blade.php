@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Live Classes</h2>
        <a href="{{ route('admin.live_classes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Live Class
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Time Slot</th>
                            <th>Meeting Link</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($liveClasses as $class)
                        <tr>
                            <td>{{ $class->time_slot }}</td>
                            <td>
                                <a href="{{ $class->meeting_link }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">
                                    {{ $class->meeting_link }}
                                </a>
                            </td>
                            <td>
                                @if($class->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.live_classes.edit', $class->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.live_classes.destroy', $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this live class?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No live classes found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $liveClasses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
