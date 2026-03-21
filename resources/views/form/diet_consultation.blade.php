@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border overflow-hidden rounded-4">
                    <div class="card-header bg-success text-white text-center pt-4 pb-3">
                        <h3 class="fw-bold mb-0">Diet Consultation Request</h3>
                        <p class="mb-0 text-white-50">Book a consultation for just ₹100</p>
                    </div>
                    <div class="card-body p-4 p-md-5">

                        <form id="consultationForm">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control bg-light border py-2" value="{{ old('name', optional(auth()->user())->first_name . ' ' . optional(auth()->user())->last_name) }}" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control bg-light border py-2" value="{{ old('email', optional(auth()->user())->email) }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                                    <input type="tel" id="phone" name="phone" class="form-control bg-light border py-2" value="{{ old('phone', optional(auth()->user())->phone) }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="call_back_datetime" class="form-label fw-semibold">Preferred Call-back Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="call_back_datetime" name="call_back_datetime" class="form-control bg-light border py-2" required>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" id="pay-btn" class="btn btn-success py-3 fw-bold rounded-pill shadow-sm">
                                    Pay ₹100 & Book Consultation
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <small class="text-muted"><i class="bi bi-shield-lock-fill text-success"></i> Secure Payment via Razorpay</small>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="module">
    $(document).ready(function() {
        $('#consultationForm').on('submit', function(e) {
            e.preventDefault();
            
            let form = $(this);
            let btn = $('#pay-btn');
            
            // Basic Validation
            if (!$('#name').val() || !$('#email').val() || !$('#phone').val() || !$('#call_back_datetime').val()) {
                Swal.fire({ text: "Please fill all fields.", icon: "error" });
                return;
            }

            let originalText = btn.text();
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            $.ajax({
                url: "{{ route('diet_consultation.order') }}",
                type: "POST",
                data: form.serialize(),
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(order) {
                    var options = {
                        key: "{{ env('RAZORPAY_KEY') }}",
                        amount: order.amount,
                        currency: "INR",
                        name: "Yogakavi Wellness",
                        description: "Diet Consultation",
                        order_id: order.id,
                        handler: function(response) {
                            // After Payment Success
                            $.ajax({
                                url: "{{ route('diet_consultation.verify') }}",
                                type: "POST",
                                contentType: "application/json",
                                data: JSON.stringify(response),
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                success: function(verifyRes) {
                                    if(verifyRes.status === 'success') {
                                        Swal.fire({
                                            title: "Success",
                                            text: "Payment Successful! We will contact you at the requested time.",
                                            icon: "success"
                                        }).then(() => {
                                            window.location.href = verifyRes.redirect_url;
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    Swal.fire({ text: 'Payment Verification Failed', icon: 'error' });
                                    btn.prop('disabled', false).text(originalText);
                                }
                            });
                        },
                        prefill: {
                            name: $("#name").val(),
                            email: $("#email").val(),
                            contact: $("#phone").val()
                        },
                        theme: {
                            color: "#198754"
                        },
                        modal: {
                            ondismiss: function() {
                                btn.prop('disabled', false).text(originalText);
                            }
                        }
                    };

                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                },
                error: function(xhr) {
                    Swal.fire({ text: xhr.responseJSON?.message || 'Something went wrong!', icon: 'error' });
                    btn.prop('disabled', false).text(originalText);
                }
            });
        });
    });
</script>
@endsection
