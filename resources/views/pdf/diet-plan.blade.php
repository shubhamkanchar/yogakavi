<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Diet Plan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10.5px;
            color: #2c3e50;
            line-height: 1.45;
        }
        h2 { text-align: center; border-bottom: 2px solid #1a4f3a; padding-bottom: 7px;
             text-transform: uppercase; font-size: 15px; color: #1a4f3a; margin-bottom: 14px; }
        h3 { font-size: 11px; border-left: 3px solid #1a4f3a; padding-left: 6px;
             margin-top: 16px; margin-bottom: 8px; color: #1a4f3a; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
        th, td { border: 1px solid #bdc3c7; padding: 5px 7px; font-size: 10px; }
        th { background-color: #f4f6f6; color: #1a4f3a; font-weight: bold; }

        /* Profile */
        .profile-table th { width: 28%; text-align: left; }
        .profile-table td { text-align: left; }

        /* Metrics */
        .metrics-table th, .metrics-table td { text-align: center; }
        .badge { background: #eef7f2; color: #1a4f3a; padding: 2px 6px;
                 border-radius: 4px; font-weight: bold; }

        /* Exchange list */
        .exchange-table th { text-align: center; background: #1a4f3a; color: #fff; }
        .exchange-table td { text-align: center; }
        .exchange-table td.ex-name { text-align: left; font-weight: 600; }
        .exchange-table tfoot td {
            font-weight: bold; background: #e8f5e9;
            border-top: 2px solid #1a4f3a;
        }

        /* Diet chart */
        .diet-table th, .diet-table td { text-align: center; font-size: 9.5px; }
        .diet-table td { vertical-align: middle; }
        .day-label { font-weight: bold; white-space: nowrap; }
    </style>
</head>
<body>

<h2>Diet &amp; Nutrition Plan</h2>

{{-- 1. CLIENT PROFILE --}}
@if(!empty($profile))
<h3>1. Client Profile</h3>
<table class="profile-table">
    <thead><tr><th>Particulars</th><th>Details</th></tr></thead>
    <tbody>
        @foreach($profile as $particular => $detail)
        <tr>
            <td><strong>{{ $particular }}</strong></td>
            <td>{{ $detail }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{-- 2. HEALTH ASSESSMENT --}}
@if(!empty($metrics) && array_filter($metrics))
<h3>2. Health Assessment Summary</h3>
<table class="metrics-table">
    <thead>
        <tr>
            @foreach($metrics as $metric => $val)
                @if($val)<th>{{ $metric }}</th>@endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($metrics as $metric => $val)
                @if($val)<td><span class="badge">{{ $val }}</span></td>@endif
            @endforeach
        </tr>
    </tbody>
</table>
@endif

{{-- 3. EXCHANGE LIST --}}
@if(!empty($exchanges))
<h3>3. Exchange List</h3>
<table class="exchange-table">
    <thead>
        <tr>
            <th style="text-align:left; width:22%;">Exchange Group</th>
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
            <td class="ex-name">{{ $ex['name'] }}</td>
            <td>{{ $ex['exchange_no'] }}</td>
            <td>{{ $ex['std_amount'] }}</td>
            <td>{{ $ex['amount'] }}</td>
            <td>{{ $ex['energy'] }}</td>
            <td>{{ $ex['protein'] }}</td>
            <td>{{ $ex['carbs'] }}</td>
            <td>{{ $ex['fat'] }}</td>
        </tr>
        @endforeach
    </tbody>
    @if(!empty($totals))
    <tfoot>
        <tr>
            <td colspan="2" style="text-align:left; padding-left:8px;"><strong>Total</strong></td>
            <td>-</td>
            <td><strong>{{ $totals['amount'] }}</strong></td>
            <td><strong>{{ $totals['energy'] }}</strong></td>
            <td><strong>{{ $totals['protein'] }}</strong></td>
            <td><strong>{{ $totals['carbs'] }}</strong></td>
            <td><strong>{{ $totals['fat'] }}</strong></td>
        </tr>
    </tfoot>
    @endif
</table>
@endif

{{-- 4. WEEKLY DIET CHART --}}
<h3>{{ !empty($exchanges) ? '4' : '3' }}. Personalized Weekly Diet Chart</h3>
<table class="diet-table">
    <thead>
        <tr>
            <th style="width:8%;">Day</th>
            <th style="width:20%;">Breakfast</th>
            <th style="width:8%;">Wt (g)</th>
            <th style="width:20%;">Lunch</th>
            <th style="width:8%;">Wt (g)</th>
            <th style="width:20%;">Snacks</th>
            <th style="width:8%;">Wt (g)</th>
            <th style="width:20%;">Dinner</th>
            <th style="width:8%;">Wt (g)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dietDetails as $row)
        <tr>
            <td class="day-label">Day {{ $row->day_number }}</td>
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

</body>
</html>
