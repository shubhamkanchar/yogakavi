@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Manage Plans</h2>
        <a href="{{ route('admin.plans.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create New Plan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted text-uppercase small font-weight-bold">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Discount</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                            <tr>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle me-3" style="width: 12px; height: 12px; background-color: {{ $plan->color }}"></div>
                                        <span class="font-weight-medium">{{ $plan->name }}</span>
                                    </div>
                                    <div class="ms-4">
                                        <small class="text-muted d-block">{{ $plan->interval_days }} Days Validity</small>
                                        @if($plan->trial_days > 0)
                                            <small class="text-success d-block">{{ $plan->trial_days }} Days Trial</small>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4">
                                    <span class="badge bg-secondary-soft text-secondary text-capitalize">
                                        {{ $plan->type }}
                                    </span>
                                </td>
                                <td class="px-4">
                                    @if($plan->discount_type && $plan->discount_value > 0)
                                        <del class="small text-muted">₹{{ number_format($plan->price, 2) }}</del>
                                        <div class="text-dark font-weight-bold">₹{{ number_format($plan->discounted_price, 2) }}</div>
                                    @else
                                        <span class="text-dark font-weight-bold">₹{{ number_format($plan->price, 2) }}</span>
                                    @endif
                                </td>
                                <td class="px-4">
                                    @if($plan->discount_type && $plan->discount_value > 0)
                                        <span class="text-success small">
                                            @if($plan->discount_type === 'percentage')
                                                {{ $plan->discount_value }}% Off
                                            @else
                                                ₹{{ $plan->discount_value }} Off
                                            @endif
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="px-4">
                                    @if($plan->is_active)
                                        <span class="badge bg-success-soft text-success">Active</span>
                                    @else
                                        <span class="badge bg-danger-soft text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-sm btn-outline-primary border-0" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-5 text-center text-muted">
                                    No plans found. <a href="{{ route('admin.plans.create') }}">Create your first plan</a>.
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

@section('style')
<style>
    .bg-success-soft { background-color: rgba(40, 167, 69, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .bg-secondary-soft { background-color: rgba(108, 117, 125, 0.1); }
    .font-weight-medium { font-weight: 500; }
    .font-weight-bold { font-weight: 600; }
</style>
@endsection
