<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th { background: #f2f2f2; }
    </style>
</head>
<body>

<h3 style="text-align:center">Batch Attendance Report</h3>

<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Batch</th>
            <th>P</th>
            <th>A</th>
            <th>L</th>
            <th>E</th>
            <th>Total</th>
            <th>%</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $row)
        <tr>
            <td>{{ $row['student'] }}</td>
            <td>{{ $row['batch'] }}</td>
            <td>{{ $row['present'] }}</td>
            <td>{{ $row['absent'] }}</td>
            <td>{{ $row['late'] }}</td>
            <td>{{ $row['excused'] }}</td>
            <td>{{ $row['total'] }}</td>
            <td>{{ $row['percentage'] }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
