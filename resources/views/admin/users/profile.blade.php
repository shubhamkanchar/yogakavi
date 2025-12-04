@extends('admin.layout')
@section('style')
    <style>
        body {
            background: #f2f6ff;
            font-family: 'Poppins', sans-serif;
        }

        .profile-header {
            background: linear-gradient(135deg, #4b79a1, #283e51);
            color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .section-card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            border: none;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-weight: 600;
            color: #283e51;
            margin-bottom: 15px;
        }

        .value-box {
            background: #eef3ff;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 500;
            color: #283e51;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">  
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </div>
    <div class="container py-5">

        <!-- HEADER -->
        <div class="profile-header mb-4 text-center">
            <h2 class="fw-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
            <p class="mb-1">{{ $user->email }}</p>
            <span class="badge bg-warning text-dark px-3 py-2 fs-6">{{ ucfirst($user->subscription) }} Subscription</span>
        </div>


        <!-- COMMON DETAILS -->
        <div class="section-card">
            <h4 class="section-title">Common Details</h4>

            <div class="row g-3">
                <div class="col-md-4">
                    <label>Phone</label>
                    <div class="value-box">{{ $user->phone }}</div>
                </div>

                <div class="col-md-4">
                    <label>Age</label>
                    <div class="value-box">{{ $user->age }}</div>
                </div>

                <div class="col-md-4">
                    <label>Height</label>
                    <div class="value-box">{{ $user->height }}</div>
                </div>

                <div class="col-md-4">
                    <label>Weight</label>
                    <div class="value-box">{{ $user->weight }}</div>
                </div>
            </div>
        </div>


        <!-- YOGA DETAILS (IF EXISTS) -->
        @if (isset($user->yogaLead))
            <div class="section-card">
                <h4 class="section-title text-success">Yoga Details</h4>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Disease</label>
                        <div class="value-box">{{ $user->yogaLead->disease }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Surgery</label>
                        <div class="value-box">{{ $user->yogaLead->surgery }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Workout Type</label>
                        <div class="value-box">{{ $user->yogaLead->workout_type }}</div>
                    </div>

                    <div class="col-md-12">
                        <label>Reason for Yoga</label>
                        <div class="value-box">{{ $user->yogaLead->reason }}</div>
                    </div>
                </div>
            </div>
        @endif


        <!-- DIET DETAILS (IF EXISTS) -->
        @if (isset($user->dietLead))
            <div class="section-card">
                <h4 class="section-title text-danger">Diet Details</h4>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Past Surgery</label>
                        <div class="value-box">{{ $user->dietLead->past_surgery }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Surgery Details</label>
                        <div class="value-box">{{ $user->dietLead->surgery_details }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Thyroid</label>
                        <div class="value-box">{{ $user->dietLead->thyroid }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Diet Preference</label>
                        <div class="value-box">{{ $user->dietLead->diet_pref }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Routine</label>
                        <div class="value-box">{{ $user->dietLead->routine }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Allergy</label>
                        <div class="value-box">{{ $user->dietLead->allergy }}</div>
                    </div>

                    <div class="col-md-12">
                        <label>Allergy Details</label>
                        <div class="value-box">{{ $user->dietLead->allergy_details }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Occupation</label>
                        <div class="value-box">{{ $user->dietLead->occupation }}</div>
                    </div>

                    <div class="col-md-4">
                        <label>Phone</label>
                        <div class="value-box">{{ $user->dietLead->phone }}</div>
                    </div>

                    <div class="col-md-12">
                        <label>Notes</label>
                        <div class="value-box">{{ $user->dietLead->notes }}</div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
