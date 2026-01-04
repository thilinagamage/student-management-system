<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f1f1f1;
        }
    </style>
</head>

<body>

    <h3 style="text-align:center;">Teacher Attendance Report</h3>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Teacher</th>
                <th>Batch</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Time</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $row)
                <tr>
                    <td>{{ $row->attendance_date }}</td>
                    <td>{{ $row->teacher->full_name }}</td>
                    <td>{{ $row->batch->code }}</td>
                    <td>{{ $row->subject->name }}</td>
                    <td>{{ ucfirst($row->status) }}</td>
                    <td>{{ $row->start_time }} - {{ $row->end_time }}</td>
                    <td>{{ $row->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
