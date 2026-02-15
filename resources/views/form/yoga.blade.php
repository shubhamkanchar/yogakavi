@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card shadow-lg border overflow-hidden rounded-4">
                    <div class="row g-0">
                        <!-- Form Section -->
                        <div class="col-lg-7 p-4 p-md-5">
                            <h2 class="fw-bold mb-4 text-primary">Yoga Registration</h2>
                            <p class="text-muted mb-4">Join our yoga sessions to find balance and harmony.</p>
                            
                            <form id="wellnessForm" method="POST" action="{{ route('yoga.lead') }}">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                                        <input type="text" id="firstName" name="first_name" class="form-control bg-light border py-2" value="{{ old('first_name', optional($user)->first_name) }}" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="LastName" class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" id="LastName" name="last_name" class="form-control bg-light border py-2" value="{{ old('last_name', optional($user)->last_name) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control bg-light border py-2" value="{{ old('email', optional($user)->email) }}" required @if(optional($user)->email) readonly @endif>
                                </div>

                                @guest
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control bg-light border py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password-confirm" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control bg-light border py-2" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                @endguest

                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="age" class="form-label fw-semibold">Age <span class="text-danger">*</span></label>
                                        <input type="number" id="age" name="age" class="form-control bg-light border py-2" value="{{ old('age', optional($user)->age) }}" required>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="height" class="form-label fw-semibold">Height (cm) <span class="text-danger">*</span></label>
                                        <input type="text" id="height" name="height" class="form-control bg-light border py-2" value="{{ old('height', optional($user)->height) }}" required placeholder="e.g. 170">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="weight" class="form-label fw-semibold">Weight <span class="text-danger">*</span></label>
                                        <input type="text" id="weight" name="weight" class="form-control bg-light border py-2" value="{{ old('weight', optional($user)->weight) }}" required placeholder="e.g. 70 kg">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">Phone (optional)</label>
                                    <input id="phone" name="phone" type="tel" class="form-control bg-light border py-2" value="{{ old('phone', optional($user)->phone) }}" placeholder="10-digit phone number">
                                </div>
                                
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label fw-semibold">Any Diseases? <span class="text-danger">*</span></label>
                                        <select name="disease" class="form-select bg-light border py-2" required>
                                            <option value="">Select</option>
                                            <option value="No" {{ old('disease', data_get($user, 'yogaLead.disease')) === 'No' ? 'selected' : '' }}>No</option>
                                            <option value="Yes" {{ old('disease', data_get($user, 'yogaLead.disease')) === 'Yes' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label fw-semibold">Past Surgery? <span class="text-danger">*</span></label>
                                        @php
                                            $s = old('surgery', data_get($user, 'yogaLead.surgery') ?? (data_get($user, 'dietLead.past_surgery') ? ucfirst(data_get($user, 'dietLead.past_surgery')) : ''));
                                        @endphp
                                        <select name="surgery" class="form-select bg-light border py-2" required>
                                            <option value="">Select</option>
                                            <option value="No" {{ $s === 'No' ? 'selected' : '' }}>No</option>
                                            <option value="Yes" {{ $s === 'Yes' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label fw-semibold">Regular Workout <span class="text-danger">*</span></label>
                                        <select name="workout_type" class="form-select bg-light border py-2" required>
                                            <option value="">Select type</option>
                                            <option value="Walk" {{ old('workout_type', data_get($user, 'yogaLead.workout_type')) === 'Walk' ? 'selected' : '' }}>Walk</option>
                                            <option value="Gym" {{ old('workout_type', data_get($user, 'yogaLead.workout_type')) === 'Gym' ? 'selected' : '' }}>Gym</option>
                                            <option value="Yoga" {{ old('workout_type', data_get($user, 'yogaLead.workout_type')) === 'Yoga' ? 'selected' : '' }}>Yoga</option>
                                            <option value="Aerobics" {{ old('workout_type', data_get($user, 'yogaLead.workout_type')) === 'Aerobics' ? 'selected' : '' }}>Aerobics</option>
                                            <option value="None" {{ old('workout_type', data_get($user, 'yogaLead.workout_type')) === 'None' ? 'selected' : '' }}>None</option>
                                            <option value="Other" {{ old('workout_type', data_get($user, 'yogaLead.workout_type')) === 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label fw-semibold">Expertise Level <span class="text-danger">*</span></label>
                                        <select name="expertise_level" id="expertise_level" class="form-select bg-light border py-2" required>
                                            <option value="">Select level</option>
                                            <option value="Beginner" {{ old('expertise_level', data_get($user, 'yogaLead.expertise_level')) === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="Intermediate" {{ old('expertise_level', data_get($user, 'yogaLead.expertise_level')) === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="Expert" {{ old('expertise_level', data_get($user, 'yogaLead.expertise_level')) === 'Expert' ? 'selected' : '' }}>Expert</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label fw-semibold">Preferred Time Slot <span class="text-danger">*</span></label>
                                        <select name="time_slot" id="time_slot" class="form-select bg-light border py-2" required>
                                            <option value="">Select time slot</option>
                                            {{-- Options will be populated by JS --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="reason" class="form-label fw-semibold">Reason for joining (Yoga) <span class="text-danger">*</span></label>
                                    <textarea id="reason" name="reason" class="form-control bg-light border py-2" rows="3" required>{{ old('reason', data_get($user, 'yogaLead.reason')) }}</textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-submit py-3 fw-bold rounded-3">Submit Registration</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Image Section -->
                        <div class="col-lg-5 d-none d-lg-block">
                             {{-- Placeholder if image generation fails, replaced by real image if successful --}}
                            <div class="h-100 w-100" style="background-image: url('{{ asset('storage/artifacts/yoga_practice_serene.png') }}'); background-size: cover; background-position: center;"></div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        $(document).ready(function() {
            $("#wellnessForm").validate({
                rules: {
                    // ... existing rules ...
                    // kept brief for diff
                },
                // ... existing options ...
                submitHandler: function(form) {
                    // ... existing submit handler ...
                    let submitBtn = $(".btn-submit");
                    submitBtn.prop("disabled", true).text('Submitting...');

                    $.ajax({
                        url: $(form).attr("action"),
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    text: response.msg,
                                    icon: "success"
                                }).then((result) => {
                                    window.location.href = '/dashboard';
                                });
                            } else {
                                Swal.fire({
                                    text: response.msg,
                                    icon: "error"
                                });
                                // form.reset(); // Don't reset to keep user input in case of error
                            }
                        },
                        error: function() {
                            submitBtn.prop("disabled", false).text("Submit");
                        },
                        complete: function() {
                            submitBtn.prop("disabled", false).text("Submit");
                        }
                    });
                }
            });

            // Dynamic Time Slots Logic
            const timeSlotSelect = $('#time_slot');
            const expertiseSelect = $('#expertise_level');
            const selectedTimeSlot = "{{ old('time_slot', data_get($user, 'yogaLead.time_slot')) }}";

            const slots = {
                beginner: [
                    "9 AM to 10 AM",
                    "7 PM to 8 PM"
                ],
                other: [
                    "5.15 AM to 6.15 AM",
                    "6.15 AM to 7.15 AM",
                    "7.30 AM to 8.30 AM"
                ]
            };

            function updateTimeSlots() {
                const level = expertiseSelect.val();
                timeSlotSelect.empty();
                timeSlotSelect.append('<option value="">Select time slot</option>');

                let options = [];
                if (level === 'Beginner') {
                    options = slots.beginner;
                } else if (level === 'Intermediate' || level === 'Expert') {
                    options = slots.other;
                }

                options.forEach(slot => {
                    const isSelected = slot === selectedTimeSlot ? 'selected' : '';
                    timeSlotSelect.append(`<option value="${slot}" ${isSelected}>${slot}</option>`);
                });
            }

            // Initial call to set slots based on current/old value
            updateTimeSlots();

            // Event listener
            expertiseSelect.on('change', updateTimeSlots);
        });
    </script>
@endsection
