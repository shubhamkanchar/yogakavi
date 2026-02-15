<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Diet Plan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<h2>Personalized Diet Plan</h2>

<table>
    <thead>
        <tr>
            <th>Day</th>
            <th>Breakfast</th>
            <th>Wt (g)/Quantity</th>
            <th>Lunch</th>
            <th>Wt (g)/Quantity</th>
            <th>Snacks</th>
            <th>Wt (g)/Quantity</th>
            <th>Dinner</th>
            <th>Wt (g)/Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dietDetails as $row)
            <tr>
                <td>Day {{ $row->day_number }}</td>
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

</body>
</html>
