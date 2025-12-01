@extends('admin.layout')
@section('content')
    <!-- 🌟 PAGE CONTENT -->
    <div id="content" class="content full">

        <h2 class="fw-bold mb-4">Dashboard Overview</h2>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted">Total Users</p>
                        <h3>1,245</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted">Leads</p>
                        <h3>420</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted">Orders</p>
                        <h3>98</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="text-muted">Revenue</p>
                        <h3>$8,590</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
