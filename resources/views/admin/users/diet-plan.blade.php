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
                <h2 class="mb-4 fw-bold">Diet Plan</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Breakfast</th>
                            <th>Wt (g)</th>
                            <th>Lunch</th>
                            <th>Wt (g)</th>
                            <th>Snacks</th>
                            <th>Wt (g)</th>
                            <th>Dinner</th>
                            <th>Wt (g)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dietDetails as $row)
                            <tr>
                                <td>Day {{ $row->day_number }} - {{ucfirst($row->weekday)}}</td>
                                <td>{{ $row->breakfast }}</td>
                                <td>{{ $row->breakfast_weight }}</td>
                                <td>{{ $row->lunch }}</td>
                                <td>{{ $row->lunch_weight }}</td>
                                <td>{{ $row->snacks }}</td>
                                <td>{{ $row->snacks_weight }}</td>
                                <td>{{ $row->dinner }}</td>
                                <td>{{ $row->dinner_weight }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
