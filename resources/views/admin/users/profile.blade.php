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
            <div class="col-md-6">
                <h2 class="mb-4 fw-bold">User Profile</h2>
            </div>
            <div class="col-md-6 text-md-end">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    @if(in_array('diet',$user->subscription) || in_array('combo',$user->subscription))
                        <a href="{{ route('admin.diet.create', ['uuid' => $user->uuid]) }}" class="btn btn-success ms-2">Generate Diet</a>
                    @endif
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="profile-header mb-4  row">
                    <div class="col-md-7">
                        <h2 class="fw-bold">{{ $user->first_name }} {{ $user->last_name }}</h2>
                        <p class="mb-1">{{ $user->email }}</p>
                    </div>
                    <div class="col-md-5">
@if($user->activeSubscription)
                            <div class="mt-2">
                                <span class="badge bg-white text-dark px-3 py-2 fs-6 shadow-sm border mb-2">Plan: {{ $user->activeSubscription->plan->name }}</span>
                                <br>
                                @php $sub = $user->activeSubscription; @endphp
                                @if($sub->status === 'trial')
                                    <span class="badge bg-info text-dark px-3 py-2 fs-6 shadow-sm">Trial (Ends: {{ $sub->trial_ends_at->format('d M') }})</span>
                                @elseif($sub->status === 'pending_payment')
                                    <span class="badge bg-danger px-3 py-2 fs-6 shadow-sm">Trial Ended - Payment Pending</span>
                                @elseif($sub->status === 'active')
                                    <span class="badge bg-success px-3 py-2 fs-6 shadow-sm">Active (Expires: {{ $sub->expiry_date->format('d M') }})</span>
                                @endif
                            </div>
                        @else
                            <span class="badge bg-secondary px-3 py-2 fs-6 shadow-sm mt-2">No Active Subscription</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-card">
                    <h4 class="section-title">Common Details</h4>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label>Phone</label>
                            <div class="value-box">{{ $user->phone }}</div>
                        </div>

                        <div class="col-md-3">
                            <label>Age</label>
                            <div class="value-box">{{ $user->age }}</div>
                        </div>

                        <div class="col-md-3">
                            <label>Height</label>
                            <div class="value-box">{{ $user->height }}</div>
                        </div>

                        <div class="col-md-3">
                            <label>Weight</label>
                            <div class="value-box">{{ $user->weight }}</div>
                        </div>
                    </div>
                </div>

            </div>
            @if (isset($user->yogaLead))
                <div class="col-md-12">
                    <div class="section-card">
                        <h4 class="section-title text-success">Yoga Details</h4>

                        <div class="row g-3">
                            <div class="col-md-2">
                                <label>Disease</label>
                                <div class="value-box">{{ $user->yogaLead->disease }}</div>
                            </div>

                            <div class="col-md-2">
                                <label>Surgery</label>
                                <div class="value-box">{{ $user->yogaLead->surgery }}</div>
                            </div>

                            <div class="col-md-2">
                                <label>Workout Type</label>
                                <div class="value-box">{{ $user->yogaLead->workout_type }}</div>
                            </div>

                            <div class="col-md-6">
                                <label>Reason for Yoga</label>
                                <div class="value-box">{{ $user->yogaLead->reason }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            @if (isset($user->dietLead))
                <div class="col-md-6">
                    <div class="section-card">
                        <h4 class="section-title text-danger">Diet Details</h4>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Past Surgery</label>
                                <div class="value-box">{{ $user->dietLead->past_surgery }}</div>
                            </div>
                            @if ($user->dietLead->surgery_details)
                                <div class="col-md-4">
                                    <label>Surgery Details</label>
                                    <div class="value-box">{{ $user->dietLead->surgery_details }}</div>
                                </div>
                            @endif

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
                            @if ($user->dietLead->allergy_details)
                                <div class="col-md-12">
                                    <label>Allergy Details</label>
                                    <div class="value-box">{{ $user->dietLead->allergy_details }}</div>
                                </div>
                            @endif
                            <div class="col-md-4">
                                <label>Occupation</label>
                                <div class="value-box">{{ $user->dietLead->occupation }}</div>
                            </div>

                            <div class="col-md-4">
                                <label>Phone</label>
                                <div class="value-box">{{ $user->dietLead->phone }}</div>
                            </div>

                            @if ($user->dietLead->notes)
                                <div class="col-md-12">
                                    <label>Notes</label>
                                    <div class="value-box">{{ $user->dietLead->notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-card">
                        <h4 class="section-title text-danger">Diet Plan</h4>
                        <div class="row">
                            <div class="col-md-12">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
