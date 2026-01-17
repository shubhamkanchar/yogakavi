@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="fw-bold mb-0 text-primary">Edit Subscription</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">User</label>
                            <input type="text" class="form-control" value="{{ $subscription->user->full_name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Plan</label>
                            <input type="text" class="form-control" value="{{ $subscription->plan->name }} ({{ ucfirst($subscription->plan_type) }})" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="trial" {{ $subscription->status == 'trial' ? 'selected' : '' }}>Trial</option>
                                <option value="pending_payment" {{ $subscription->status == 'pending_payment' ? 'selected' : '' }}>Pending Payment</option>
                                <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                <option value="cancelled" {{ $subscription->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="expiry_date" class="form-label fw-bold">Expiry Date</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror" 
                                value="{{ $subscription->expiry_date ? $subscription->expiry_date->format('Y-m-d') : '' }}">
                            @error('expiry_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">Update Subscription</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
