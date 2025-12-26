@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        <h2 class="fw-bold mb-4">Dashboard Overview</h2>

        <!-- Summary Cards -->
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

            <div class="col-md-3">
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
            </div>

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
    </div>
@endsection
