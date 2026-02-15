@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.live_classes.index') }}" class="text-decoration-none">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <h2 class="fw-bold mt-2">Add New Live Class</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.live_classes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="time_slot" class="form-label fw-semibold">Time Slot</label>
                        <select name="time_slot" id="time_slot" class="form-select @error('time_slot') is-invalid @enderror" required>
                            <option value="">Select Slot</option>
                            @foreach($slots as $slot)
                                <option value="{{ $slot }}" {{ old('time_slot') == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                            @endforeach
                        </select>
                        @error('time_slot')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="meeting_link" class="form-label fw-semibold">Google Meet Link</label>
                    <input type="url" name="meeting_link" id="meeting_link" class="form-control @error('meeting_link') is-invalid @enderror" value="{{ old('meeting_link') }}" placeholder="https://meet.google.com/xxx-xxxx-xxx" required>
                    @error('meeting_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Active</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-5">Create Live Class</button>
            </form>
        </div>
    </div>
</div>
@endsection
