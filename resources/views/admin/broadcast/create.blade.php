@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">Create Broadcast</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.broadcast.preview') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="meet_link" class="form-label">Google Meet Link</label>
                    <input type="url" class="form-control" id="meet_link" name="meet_link" placeholder="https://meet.google.com/..." required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Enter your message here..."></textarea>
                    <div class="form-text">The class link will be automatically appended to this message.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Next: Preview & Send <i class="bi bi-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
