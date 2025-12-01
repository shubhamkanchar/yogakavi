@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Yoga form</div>
                    <div class="card-body">
                        <form id="wellnessForm" method="POST" action="{{ route('yoga.lead') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="firstName" name="first_name" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="LastName" class="form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="LastName" name="last_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="age" class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="number" id="age" name="age" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="height" class="form-label">Height <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="height" name="height" class="form-control" required
                                        placeholder="e.g. 5'6\" / 170 cm">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight <span class="text-danger">*</span></label>
                                <input type="text" id="weight" name="weight" class="form-control" required
                                    placeholder="e.g. 70 kg">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Do you have any Diseases? <span
                                        class="text-danger">*</span></label>
                                <select name="disease" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Past Surgery? <span class="text-danger">*</span></label>
                                <select name="surgery" class="form-select" required>
                                    <option value="">Select</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Regular Workout Type <span class="text-danger">*</span></label>
                                <select name="workout_type" class="form-select" required>
                                    <option value="">Select workout type</option>
                                    <option value="Walk">Walk</option>
                                    <option value="Gym">Gym</option>
                                    <option value="Yoga">Yoga</option>
                                    <option value="Aerobics">Aerobics</option>
                                    <option value="None">None</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason for joining (Yoga) <span
                                        class="text-danger">*</span></label>
                                <textarea id="reason" name="reason" class="form-control" rows="3" required></textarea>
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
                    submitBtn.prop("disabled", true).text("Submitting...");

                    $.ajax({
                        url: $(form).attr("action"),
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            submitBtn.prop("disabled", false).text("Submit");
                            $(".form-container").prepend(`<div class="alert alert-success mt-3">Form submitted successfully!</div>`);
                            form.reset();
                        },
                        error: function() {
                            submitBtn.prop("disabled", false).text("Submit");
                            $(".form-container").prepend(`<div class="alert alert-danger mt-3">Something went wrong! Please try again.</div>`);
                        }
                    });
                }
            });
        });
    </script>
@endsection
