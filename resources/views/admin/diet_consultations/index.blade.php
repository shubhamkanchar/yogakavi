@extends('admin.layout')

@section('content')
<div class="content full">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Diet Consultations</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Contact Info</th>
                                <th>Call Back Time</th>
                                <th>Payment ID</th>
                                <th>Status</th>
                                <th>Date Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($consultations as $consultation)
                                <tr>
                                    <td><strong>{{ $consultation->name }}</strong></td>
                                    <td>
                                        <div class="text-muted small"><i class="bi bi-envelope"></i> {{ $consultation->email }}</div>
                                        <div class="text-muted small"><i class="bi bi-telephone"></i> {{ $consultation->phone }}</div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($consultation->call_back_datetime)->format('d M Y, h:i A') }}</td>
                                    <td><small>{{ $consultation->razorpay_payment_id ?? 'N/A' }}</small></td>
                                    <td>
                                        @if($consultation->status === 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ ucfirst($consultation->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $consultation->created_at->format('d M Y, h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No consultations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-end mt-3">
                    {{ $consultations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
