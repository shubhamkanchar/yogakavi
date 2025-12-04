@extends('admin.layout')
@section('content')
    <div class="container-fuild py-4">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@section('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection