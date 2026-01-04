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
