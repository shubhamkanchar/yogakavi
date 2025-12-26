@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-white border-0 text-center pt-5">
                    <h4 class="fw-bold mb-0">Order Summary</h4>
                    <p class="text-muted small">You are one step away from starting your journey!</p>
                </div>
                <div class="card-body p-5">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-3">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $plan->name }}</h5>
                            <span class="badge bg-primary rounded-pill">{{ $plan->interval_days }} Days Access</span>
                        </div>
                        <div class="text-end">
                            <h3 class="fw-bold text-primary mb-0">₹{{ number_format($plan->price, 0) }}</h3>
                        </div>
                    </div>

                    <ul class="list-unstyled mb-5 text-muted">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> {{ $plan->description }}</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Premium Support</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Instant Activation</li>
                    </ul>

                    <button id="pay-btn" class="btn btn-dark w-100 py-3 rounded-pill fw-bold shadow-sm"
                        data-id="{{ $plan->uuid }}"
                        data-name="{{ $plan->name }}"
                        data-price="{{ $plan->price }}">
                        Pay ₹{{ number_format($plan->price, 0) }} Now
                    </button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="bi bi-lock-fill me-1"></i> Secure Payment via Razorpay</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="module">
    $(document).on('click', '#pay-btn', function() {
        let button = $(this);
        let planId = button.data('id'); // This is now UUID
        let planName = button.data('name');
        let originalText = button.text();

        // Loading State
        button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

        $.ajax({
            url: '/create-order/' + planId,
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(order) {
                var options = {
                    key: "{{env('RAZORPAY_KEY')}}",
                    amount: order.amount,
                    currency: "INR",
                    name: "Yogakavi Wellness",
                    description: "Payment for " + planName,
                    order_id: order.id,
                    handler: function(response) {
                        $.ajax({
                            url: '/verify-payment/' + planId,
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify(response),
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    window.location.href = '/dashboard';
                                }
                            },
                            error: function(xhr) {
                                alert('Payment Verification Failed: ' + (xhr.responseJSON?.error || 'Unknown Error'));
                                button.prop('disabled', false).text(originalText);
                            }
                        });
                    },
                    modal: {
                        ondismiss: function() {
                            button.prop('disabled', false).text(originalText);
                        }
                    }
                };

                new Razorpay(options).open();
            },
            error: function() {
                alert('Something went wrong! Please try again.');
                button.prop('disabled', false).text(originalText);
            }
        });
    });
</script>
@endsection
