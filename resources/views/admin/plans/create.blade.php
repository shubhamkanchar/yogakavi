@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.plans.index') }}" class="btn btn-link text-decoration-none p-0 me-3">
                    <i class="bi bi-arrow-left fs-4"></i>
                </a>
                <h2 class="h4 mb-0">Create New Plan</h2>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.plans.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="name" class="form-label">Plan Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Yoga - 1 Month">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="color" class="form-label">Theme Color</label>
                                <input type="color" class="form-control form-control-color w-100" id="color" name="color" value="{{ old('color', '#667eea') }}" title="Choose plan color">
                                @error('color')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="type" class="form-label">Plan Type</label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="yoga" {{ old('type') == 'yoga' ? 'selected' : '' }}>Yoga</option>
                                    <option value="diet" {{ old('type') == 'diet' ? 'selected' : '' }}>Diet</option>
                                    <option value="combo" {{ old('type') == 'combo' ? 'selected' : '' }}>Combo</option>
                                    <option value="personal" {{ old('type') == 'personal' ? 'selected' : '' }}>Personal</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="interval_days" class="form-label">Duration (Days)</label>
                                <input type="number" class="form-control @error('interval_days') is-invalid @enderror" id="interval_days" name="interval_days" value="{{ old('interval_days') }}" required min="1" placeholder="30">
                                @error('interval_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="trial_days" class="form-label">Trial (Days)</label>
                                <input type="number" class="form-control @error('trial_days') is-invalid @enderror" id="trial_days" name="trial_days" value="{{ old('trial_days', 0) }}" required min="0" placeholder="0">
                                @error('trial_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="price" class="form-label">Base Price (₹)</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required min="0" placeholder="1000">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="discount_type" class="form-label">Discount Type</label>
                                <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type">
                                    <option value="" selected>None</option>
                                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                                </select>
                                @error('discount_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="discount_value" class="form-label">Discount Value</label>
                                <input type="number" step="0.01" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" name="discount_value" value="{{ old('discount_value', 0) }}" min="0">
                                @error('discount_value')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Plan details or features...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Plan is Active</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Create Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
