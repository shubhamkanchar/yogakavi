@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header h3">Yoga Form</div>
                    <div class="card-body">
                        <form id="wellnessForm" method="POST" action="{{ route('yoga.lead') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="firstName" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="LastName" class="form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="LastName" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required @if($user) readonly @endif>
                            </div>


                            @guest
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm"
                                        class="col-form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            @endguest

                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="number" id="age" name="age" class="form-control" value="{{ old('age', $user->age ?? '') }}" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="height" class="form-label">Height (cm) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="height" name="height" class="form-control" value="{{ old('height', $user->height ?? '') }}" required
                                        placeholder="e.g. 170">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="weight" class="form-label">Weight <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="weight" name="weight" class="form-control" value="{{ old('weight', $user->weight ?? '') }}" required
                                        placeholder="e.g. 70 kg">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone (optional)</label>
                                <input id="phone" name="phone" type="tel" class="form-control" value="{{ old('phone', $user->phone ?? '') }}"
                                    placeholder="10-digit phone number">
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Do you have any Diseases? <span
                                            class="text-danger">*</span></label>
                                    <select name="disease" class="form-select" required>
                                        <option value="">Select</option>
                                        <option value="No" {{ old('disease', $user->yogaLead->disease ?? '') === 'No' ? 'selected' : '' }}>No</option>
                                        <option value="Yes" {{ old('disease', $user->yogaLead->disease ?? '') === 'Yes' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Past Surgery? <span class="text-danger">*</span></label>
                                    @php
                                        $s = old('surgery', $user->yogaLead->surgery ?? (isset($user->dietLead->past_surgery) ? ucfirst($user->dietLead->past_surgery) : ''));
                                    @endphp
                                    <select name="surgery" class="form-select" required>
                                        <option value="">Select</option>
                                        <option value="No" {{ $s === 'No' ? 'selected' : '' }}>No</option>
                                        <option value="Yes" {{ $s === 'Yes' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Regular Workout Type <span
                                            class="text-danger">*</span></label>
                                    <select name="workout_type" class="form-select" required>
                                        <option value="">Select workout type</option>
                                        <option value="Walk" {{ old('workout_type', $user->yogaLead->workout_type ?? '') === 'Walk' ? 'selected' : '' }}>Walk</option>
                                        <option value="Gym" {{ old('workout_type', $user->yogaLead->workout_type ?? '') === 'Gym' ? 'selected' : '' }}>Gym</option>
                                        <option value="Yoga" {{ old('workout_type', $user->yogaLead->workout_type ?? '') === 'Yoga' ? 'selected' : '' }}>Yoga</option>
                                        <option value="Aerobics" {{ old('workout_type', $user->yogaLead->workout_type ?? '') === 'Aerobics' ? 'selected' : '' }}>Aerobics</option>
                                        <option value="None" {{ old('workout_type', $user->yogaLead->workout_type ?? '') === 'None' ? 'selected' : '' }}>None</option>
                                        <option value="Other" {{ old('workout_type', $user->yogaLead->workout_type ?? '') === 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason for joining (Yoga) <span
                                        class="text-danger">*</span></label>
                                <textarea id="reason" name="reason" class="form-control" rows="3" required>{{ old('reason', $user->yogaLead->reason ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-submit py-2">Submit</button>
                        </form>
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
                    email: {
                        required: true,
                        email: true
                    },
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    age: {
                        required: true,
                        number: true,
                        min: 10,
                        max: 100
                    },
                    height: {
                        required: true
                    },
                    weight: {
                        required: true
                    },
                    disease: {
                        required: true
                    },
                    surgery: {
                        required: true
                    },
                    workout_type: {
                        required: true
                    },
                    reason: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    email: "Please enter a valid email",
                    name: "Name is required",
                    age: "Enter a valid age",
                    height: "Enter your height",
                    weight: "Enter your weight",
                    reason: "Please describe your reason",
                },

                errorPlacement: function(error, element) {
                    if (element.prop("tagName").toLowerCase() === "select" || element
                        .hasClass('form-control')) {
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                    if ($(element).is('select')) {
                        $(element).addClass('is-invalid');
                    }
                },

                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
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
                                    // title: "The Internet?",
                                    text: response.msg,
                                    icon: "success"
                                }).then((result) => {
                                    window.location.href = '/dashboard';
                                });
                            } else {
                                Swal.fire({
                                    // title: "The Internet?",
                                    text: response.msg,
                                    icon: "error"
                                });
                                form.reset();
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
        });
    </script>
@endsection
