@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header h3">Health & Diet Intake Form</div>
                    <div class="card-body">
                        <form id="fullForm" method="POST" action="{{ route('diet.lead') }}" novalidate>
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
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required readonly>
                            </div>

                            @guest
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            @endguest

                            <div class="row gx-3">
                                <!-- Weight -->
                                <div class="col-md-4 mb-3">
                                    <label for="weight" class="form-label">Weight (kg) <span
                                            class="text-danger">*</span></label>
                                    <input id="weight" name="weight" type="number" min="1" step="0.1"
                                        class="form-control" value="{{ old('weight', $user->weight ?? '') }}" placeholder="e.g. 70">
                                </div>

                                <!-- Height -->
                                <div class="col-md-4 mb-3">
                                    <label for="height" class="form-label">Height (cm) <span
                                            class="text-danger">*</span></label>
                                    <input id="height" name="height" type="number" min="1" class="form-control"
                                        value="{{ old('height', $user->height ?? '') }}" placeholder="e.g. 170">
                                </div>

                                <!-- Age -->
                                <div class="col-md-4 mb-3">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input id="age" name="age" type="number" min="1" class="form-control"
                                        value="{{ old('age', $user->age ?? '') }}" placeholder="e.g. 30">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone (optional)</label>
                                <input id="phone" name="phone" type="tel" class="form-control" value="{{ old('phone', $user->phone ?? '') }}"
                                    placeholder="10-digit phone number">
                            </div>

                            <!-- Past Surgery -->
                            <div class="mb-3">
                                <label for="past_surgery" class="form-label">Any Past Surgery? <span
                                        class="text-danger">*</span></label>
                                <select id="past_surgery" name="past_surgery" class="form-select">
                                    <option value="">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>

                            <!-- Surgery details (conditional) -->
                            <div id="surgery_details_wrap" class="mb-3" style="display:none;">
                                <label for="surgery_details" class="form-label">If yes, please list surgeries / details
                                    <span class="text-danger">*</span></label>
                                <textarea id="surgery_details" name="surgery_details" class="form-control" rows="2"
                                    placeholder="Surgery details..."></textarea>
                            </div>

                            <!-- Thyroid -->
                            <div class="mb-3">
                                <label for="thyroid" class="form-label">Do you have thyroid? <span
                                        class="text-danger">*</span></label>
                                <select id="thyroid" name="thyroid" class="form-select">
                                    <option value="">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>

                            <!-- Diet Preference -->
                            <div class="mb-3">
                                <label for="diet_pref" class="form-label">Diet Preference <span
                                        class="text-danger">*</span></label>
                                <select id="diet_pref" name="diet_pref" class="form-select">
                                    <option value="">Select</option>
                                    <option value="vegetarian">Vegetarian</option>
                                    <option value="non-vegetarian">Non-vegetarian</option>
                                    <option value="eggetarian">Eggetarian</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Routine -->
                            <div class="mb-3">
                                <label for="routine" class="form-label">Daily workout / walking routine <span
                                        class="text-danger">*</span></label>
                                <input id="routine" name="routine" type="text" class="form-control"
                                    placeholder="e.g. 30 mins walking / gym 3x week">
                            </div>

                            <!-- Allergy -->
                            <div class="mb-3">
                                <label for="allergy" class="form-label">Any food allergy? <span
                                        class="text-danger">*</span></label>
                                <select id="allergy" name="allergy" class="form-select">
                                    <option value="">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Allergy details (conditional) -->
                            <div id="allergy_details_wrap" class="mb-3" style="display:none;">
                                <label for="allergy_details" class="form-label">If yes / other, please specify <span
                                        class="text-danger">*</span></label>
                                <textarea id="allergy_details" name="allergy_details" class="form-control" rows="2"
                                    placeholder="Allergy details..."></textarea>
                            </div>

                            <!-- Occupation -->
                            <div class="mb-3">
                                <label for="occupation" class="form-label">Current occupation <span
                                        class="text-danger">*</span></label>
                                <select id="occupation" name="occupation" class="form-select">
                                    <option value="">Select</option>
                                    <option value="employee">Employee</option>
                                    <option value="housewife">Housewife / Homemaker</option>
                                    <option value="retired">Retired</option>
                                    <option value="student">Student</option>
                                    <option value="self-employed">Self-employed</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            

                            <div class="mb-4">
                                <label for="notes" class="form-label">Any additional notes (optional)</label>
                                <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Add anything else..."></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

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
            $(function() {
                $('#past_surgery').on('change', function() {
                    if ($(this).val() === 'yes') {
                        $('#surgery_details_wrap').slideDown();
                    } else {
                        $('#surgery_details_wrap').slideUp();
                        $('#surgery_details').val('');
                    }
                });

                $('#allergy').on('change', function() {
                    if ($(this).val() === 'yes' || $(this).val() === 'other') {
                        $('#allergy_details_wrap').slideDown();
                    } else {
                        $('#allergy_details_wrap').slideUp();
                        $('#allergy_details').val('');
                    }
                });

                $('#fullForm').validate({
                    ignore: [],

                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        name: {
                            required: true,
                            minlength: 3
                        },
                        weight: {
                            required: true,
                            number: true,
                            min: 1
                        },
                        height: {
                            required: true,
                            number: true,
                            min: 1
                        },
                        age: {
                            required: true,
                            digits: true,
                            min: 1
                        },
                        past_surgery: {
                            required: true
                        },
                        surgery_details: {
                            required: function(el) {
                                return $('#past_surgery').val() === 'yes';
                            },
                            minlength: 3
                        },
                        thyroid: {
                            required: true
                        },
                        diet_pref: {
                            required: true
                        },
                        routine: {
                            required: true,
                            minlength: 3
                        },
                        allergy: {
                            required: true
                        },
                        allergy_details: {
                            required: function(el) {
                                const v = $('#allergy').val();
                                return v === 'yes' || v === 'other';
                            },
                            minlength: 3
                        },
                        occupation: {
                            required: true
                        },
                        phone: {
                            digits: true,
                            minlength: 10,
                            maxlength: 15
                        }
                    },

                    messages: {
                        email: {
                            required: "Please enter your email",
                            email: "Please enter a valid email address"
                        },
                        name: {
                            required: "Please enter your full name",
                            minlength: "Name must be at least 3 characters"
                        },
                        weight: {
                            required: "Please enter weight",
                            number: "Weight must be a number",
                            min: "Please enter a valid weight"
                        },
                        height: {
                            required: "Please enter height",
                            number: "Height must be a number",
                            min: "Please enter a valid height"
                        },
                        age: {
                            required: "Please enter age",
                            digits: "Age must be a whole number",
                            min: "Please enter a valid age"
                        },
                        past_surgery: {
                            required: "Please choose an option"
                        },
                        surgery_details: {
                            required: "Please provide surgery details",
                            minlength: "Please provide more details"
                        },
                        thyroid: {
                            required: "Please choose an option"
                        },
                        diet_pref: {
                            required: "Please select your diet preference"
                        },
                        routine: {
                            required: "Please describe your routine",
                            minlength: "Please provide more details"
                        },
                        allergy: {
                            required: "Please choose an option"
                        },
                        allergy_details: {
                            required: "Please provide allergy details",
                            minlength: "Please provide more details"
                        },
                        occupation: {
                            required: "Please select an occupation"
                        },
                        phone: {
                            digits: "Phone must contain only digits",
                            minlength: "Phone number is too short",
                            maxlength: "Phone number is too long"
                        }
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
                        submitBtn.prop("disabled", true).text('Submitting ..');

                        $.ajax({
                            url: $(form).attr("action"),
                            type: "POST",
                            data: $(form).serialize(),
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if(response.success){
                                    Swal.fire({
                                        // title: "The Internet?",
                                        text: response.msg,
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = '/dashboard';
                                    });
                                }else{
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
                            complete: function(){
                                submitBtn.prop("disabled", false).text("Submit");
                            }
                        });
                    }
                });

                // Reset handler: clear validation states and conditional fields
                $('#btnReset').on('click', function() {
                    $('#fullForm')[0].reset();
                    $('#fullForm').find('.is-invalid, .is-valid').removeClass(
                        'is-invalid is-valid');
                    $('#surgery_details_wrap, #allergy_details_wrap').hide();
                });

                // If the user reloads and fields have values, show conditionals appropriately
                if ($('#past_surgery').val() === 'yes') $('#surgery_details_wrap').show();
                if ($('#allergy').val() === 'yes' || $('#allergy').val() === 'other') $(
                    '#allergy_details_wrap').show();
            });
        });
    </script>
@endsection
