@extends('admin.layout')

@section('style')
<style>
    body { background: #f0f4f8; font-family: 'Poppins', sans-serif; }

    .section-card {
        background: #fff; border: none;
        border-radius: 16px;
        box-shadow: 0 2px 14px rgba(0,0,0,.07);
        overflow: hidden; margin-bottom: 24px;
    }
    .card-head {
        padding: 16px 22px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .card-head h5 { margin: 0; font-weight: 700; }
    .card-head .head-green { background: linear-gradient(135deg, #1a4f3a, #2d7a56); color: #fff; }
    .card-head .head-blue  { background: linear-gradient(135deg, #1565c0, #1e88e5); color: #fff; }
    .card-head .head-dark  { background: linear-gradient(135deg, #263238, #455a64); color: #fff; }
    .card-head .head-orange{ background: linear-gradient(135deg, #e65100, #fb8c00); color: #fff; }

    /* Profile table */
    .profile-tbl th { width: 30%; font-weight: 600; color: #555; background: #fafafa; }
    .profile-tbl th, .profile-tbl td { border-color: #e9ecef; vertical-align: middle; }

    /* Metric badges */
    .metric-badge {
        background: #f0faf4; border: 1.5px solid #c8e6c9;
        border-radius: 12px; padding: 14px 20px;
        text-align: center; flex: 1; min-width: 130px;
    }
    .metric-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; color: #888; }
    .metric-val   { font-size: 1.3rem; font-weight: 800; color: #1a4f3a; display: block; margin: 4px 0 2px; }
    .metric-unit  { font-size: .72rem; color: #aaa; }

    /* Exchange table */
    .exchange-tbl thead th {
        background: #1a4f3a; color: #fff;
        text-align: center; font-size: .8rem;
        white-space: nowrap; border: none;
    }
    .exchange-tbl td { text-align: center; font-size: .88rem; border-color: #e9ecef; vertical-align: middle; }
    .exchange-tbl td.ex-name { text-align: left; font-weight: 600; color: #1a4f3a; }
    .exchange-tbl tfoot td {
        font-weight: 700; background: #e8f5e9;
        border-top: 2px solid #1a4f3a; font-size: .9rem;
    }
    .energy-col  { color: #c62828; }
    .protein-col { color: #1565c0; }
    .carbs-col   { color: #e65100; }
    .fat-col     { color: #6a1b9a; }

    /* Diet chart */
    .diet-tbl thead th { background: #263238; color: #fff; font-size: .8rem; text-align: center; border: none; }
    .diet-tbl td { text-align: center; font-size: .87rem; vertical-align: middle; border-color: #e9ecef; }
    .diet-tbl tbody tr:hover { background: #f8f9fa; }

    .page-header {
        background: linear-gradient(135deg, #1a4f3a, #2d7a56);
        border-radius: 16px; color: #fff; padding: 22px 28px;
        box-shadow: 0 6px 24px rgba(26,79,58,.2);
        margin-bottom: 24px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    {{-- ── Page Header ── --}}
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h4 class="mb-1 fw-bold"><i class="bi bi-clipboard2-heart-fill me-2"></i>Diet Plan Dashboard</h4>
            <p class="mb-0 opacity-75 small">View full diet plan, health metrics, exchange list, and weekly chart.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('diet.plan.pdf', ['uuid' => $dietPlan->uuid]) }}"
               class="btn btn-light fw-semibold shadow-sm">
                <i class="bi bi-file-earmark-pdf-fill text-success me-1"></i> Download PDF
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light fw-semibold shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    {{-- ── Row 1: Profile + Metrics ── --}}
    <div class="row mb-0">

        {{-- Client Profile --}}
        <div class="col-lg-6 mb-4">
            <div class="section-card h-100">
                <div class="card-head head-green">
                    <h5><i class="bi bi-person-fill me-2"></i>Client Profile</h5>
                </div>
                <div class="p-3">
                    @if(!empty($profile))
                    <table class="table table-hover mb-0 profile-tbl">
                        <tbody>
                            @foreach($profile as $key => $val)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $val }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted mb-0">No profile details available.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Health Metrics --}}
        <div class="col-lg-6 mb-4">
            <div class="section-card h-100">
                <div class="card-head head-blue">
                    <h5><i class="bi bi-heart-pulse-fill me-2"></i>Health Assessment Summary</h5>
                </div>
                <div class="p-3">
                    @if(!empty($metrics) && array_filter($metrics))
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($metrics as $metric => $val)
                        @if($val)
                        <div class="metric-badge">
                            <span class="metric-label">
                                @if($metric==='IBW') Ideal Body Weight
                                @elseif($metric==='BMR') Basal Metabolic Rate
                                @elseif($metric==='TDEE') Daily Energy (TDEE)
                                @else {{ $metric }}
                                @endif
                            </span>
                            <span class="metric-val">
                                {{ preg_split('/\s/', $val)[0] }}
                            </span>
                            <span class="metric-unit">
                                {{ implode(' ', array_slice(explode(' ', $val), 1)) }}
                            </span>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted mb-0">No health metrics available (requires height &amp; weight data).</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Exchange List --}}
    @if(!empty($exchanges))
    <div class="section-card">
        <div class="card-head head-orange">
            <h5><i class="bi bi-bar-chart-steps me-2"></i>Exchange List</h5>
            @if(!empty($totals))
            <div class="d-flex gap-3 flex-wrap">
                <span class="badge bg-light text-dark fw-semibold">{{ $totals['energy'] }} kcal</span>
                <span class="badge bg-light text-dark fw-semibold">{{ $totals['protein'] }}g Protein</span>
                <span class="badge bg-light text-dark fw-semibold">{{ $totals['carbs'] }}g Carbs</span>
                <span class="badge bg-light text-dark fw-semibold">{{ $totals['fat'] }}g Fat</span>
            </div>
            @endif
        </div>
        <div class="p-3 table-responsive">
            <table class="table table-hover mb-0 exchange-tbl">
                <thead>
                    <tr>
                        <th style="text-align:left; padding-left:14px; width:22%;">Exchange Group</th>
                        <th>Exchange No.</th>
                        <th>Std. Amount (g)</th>
                        <th>Amount (g)</th>
                        <th>Energy (Kcal)</th>
                        <th>Proteins (g)</th>
                        <th>Carbs (g)</th>
                        <th>Fats (g)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exchanges as $ex)
                    <tr>
                        <td class="ex-name ps-3">{{ $ex['name'] }}</td>
                        <td>{{ $ex['exchange_no'] }}</td>
                        <td>{{ $ex['std_amount'] }}</td>
                        <td>{{ $ex['amount'] }}</td>
                        <td class="energy-col fw-semibold">{{ $ex['energy'] }}</td>
                        <td class="protein-col fw-semibold">{{ $ex['protein'] }}</td>
                        <td class="carbs-col fw-semibold">{{ $ex['carbs'] }}</td>
                        <td class="fat-col fw-semibold">{{ $ex['fat'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
                @if(!empty($totals))
                <tfoot>
                    <tr>
                        <td colspan="2" class="ps-3">Total</td>
                        <td>-</td>
                        <td>{{ $totals['amount'] }}</td>
                        <td class="energy-col">{{ $totals['energy'] }}</td>
                        <td class="protein-col">{{ $totals['protein'] }}</td>
                        <td class="carbs-col">{{ $totals['carbs'] }}</td>
                        <td class="fat-col">{{ $totals['fat'] }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
    @endif

    {{-- ── Weekly Diet Chart ── --}}
    <div class="section-card">
        <div class="card-head head-dark">
            <h5><i class="bi bi-calendar3 me-2"></i>Personalized Weekly Diet Chart</h5>
        </div>
        <div class="p-3 table-responsive">
            <table class="table table-bordered diet-tbl mb-0">
                <thead>
                    <tr>
                        <th style="width:8%;">Day</th>
                        <th>Breakfast</th>
                        <th style="width:10%;">Wt (g)/Qty</th>
                        <th>Lunch</th>
                        <th style="width:10%;">Wt (g)/Qty</th>
                        <th>Snacks</th>
                        <th style="width:10%;">Wt (g)/Qty</th>
                        <th>Dinner</th>
                        <th style="width:10%;">Wt (g)/Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dietDetails as $row)
                    <tr>
                        <td><strong>Day {{ $row->day_number }}</strong></td>
                        <td>{{ $row->breakfast }}</td>
                        <td>{{ $row->breakfast_weight ?: '-' }}</td>
                        <td>{{ $row->lunch }}</td>
                        <td>{{ $row->lunch_weight ?: '-' }}</td>
                        <td>{{ $row->snacks }}</td>
                        <td>{{ $row->snacks_weight ?: '-' }}</td>
                        <td>{{ $row->dinner }}</td>
                        <td>{{ $row->dinner_weight ?: '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
