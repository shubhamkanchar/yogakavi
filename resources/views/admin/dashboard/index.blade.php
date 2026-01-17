@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <h2 class="fw-bold mb-4">Dashboard Overview</h2>
        @if(session('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-4" style="z-index: 1050;" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-4" style="z-index: 1050;" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @endif
        @if(Auth::user()->role === 'admin')
        <!-- Admin Statistics -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 border-start border-primary border-4">
                    <div class="card-body">
                        <p class="text-muted mb-1">Total Users</p>
                        <h3 class="fw-bold">{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 border-start border-success border-4">
                    <div class="card-body">
                        <p class="text-muted mb-1">Active Subscriptions</p>
                        <h3 class="fw-bold">{{ $activeSubscriptions }}</h3>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-3">
                <div class="card shadow-sm border-0 border-start border-warning border-4">
                    <div class="card-body">
                        <p class="text-muted mb-1">Plan Distribution</p>
                        <div class="d-flex justify-content-between small">
                            <span>Yoga: {{ $planCounts['yoga'] ?? 0 }}</span>
                            <span>Diet: {{ $planCounts['diet'] ?? 0 }}</span>
                            <span>Combo: {{ $planCounts['combo'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-md-3">
                <div class="card shadow-sm border-0 border-start border-info border-4">
                    <div class="card-body">
                        <p class="text-muted mb-1">Total Revenue</p>
                        <h3 class="fw-bold">₹{{ number_format($totalRevenue) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Tables -->
        <div class="row g-4">
            <!-- Top Spenders -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Top 5 Users by Purchase Value</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User</th>
                                        <th class="text-end">Total Spent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topSpenders as $spender)
                                        <tr>
                                            <td>
                                                <div class="fw-medium">{{ $spender->user->full_name ?? 'Unknown User' }}</div>
                                                <div class="small text-muted">{{ $spender->user->email ?? '' }}</div>
                                            </td>
                                            <td class="text-end fw-bold">₹{{ number_format($spender->total_spent) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-3">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Frequent Buyers -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Top 5 Frequent Buyers</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User</th>
                                        <th class="text-end">Purchases</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($frequentBuyers as $buyer)
                                        <tr>
                                            <td>
                                                <div class="fw-medium">{{ $buyer->user->full_name ?? 'Unknown User' }}</div>
                                                <div class="small text-muted">{{ $buyer->user->email ?? '' }}</div>
                                            </td>
                                            <td class="text-end fw-bold">{{ $buyer->purchase_count }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-3">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- User Welcome Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0 p-4">
                    <div class="card-body p-0">
                        <h3 class="fw-bold text-primary">Welcome, {{ Auth::user()->full_name }}!</h3>
                        <p class="text-muted fs-5">Track your progress and manage your subscriptions from here.</p>
                        
                        <div class="mt-4 p-0 bg-light rounded-3 row">
                            <div class="col-md-6">
                                <h5 class="mb-3 fw-bold">Active Subscriptions:</h5>
                                @php $subscriptions = get_active_subscriptions(); @endphp
                                
                                @if($subscriptions->isNotEmpty())
                                    <div class="d-flex flex-column gap-3">
                                        @foreach($subscriptions as $subscription)
                                            <div class="border-start border-success border-4 ps-3 bg-white py-2 rounded-end shadow-sm">
                                                <div class="fw-bold text-dark">
                                                    {{ $subscription->plan->name ?? 'Unknown Plan' }}
                                                </div>
                                                <div class="small text-muted">
                                                    <!-- Expires: {{ $subscription->expiry_date ? $subscription->expiry_date->format('d M, Y') : 'N/A' }} -->
                                                     @if($subscription->status === 'trial')
                                                        <span class="badge bg-info text-dark px-2 py-1">Trial (Ends: {{ $subscription->trial_ends_at ? $subscription->trial_ends_at->format('d M') : 'N/A' }})</span>
                                                    @elseif($subscription->status === 'pending_payment')
                                                        <span class="badge bg-danger px-2 py-1">Trial Ended - Payment Pending</span>
                                                    @elseif($subscription->status === 'active')
                                                        <span class="badge bg-success px-2 py-1">Active (Expires: {{ $subscription->expiry_date ? $subscription->expiry_date->format('d M, Y') : 'N/A' }})</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 fs-6">
                                        No Active Plan
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('welcome') }}#plans" class="btn btn-primary rounded-pill fw-bold mt-2">
                                    <i class="bi bi-arrow-repeat me-2"></i> {{ $subscriptions->isNotEmpty() ? 'Add / Renew Plan' : 'Buy Plan' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
