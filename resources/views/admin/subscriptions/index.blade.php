@extends('admin.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold fs-2 text-primary">Subscriptions</h2>
            </div>
            <div class="col-md-6 text-md-end">
                {{-- <a href="#" class="btn btn-primary fw-bold rounded-pill ps-4 pe-4">
                    <i class="bi bi-plus-circle me-2"></i> Add New
                </a> --}}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
