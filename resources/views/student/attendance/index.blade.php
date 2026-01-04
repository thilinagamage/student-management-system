@extends('layouts.student')

@push('title')
    My Attendance
@endpush

@section('content')
    <main class="page-content">

        <h4 class="mb-3">My Attendance</h4>

        <div class="card">
            <div class="card-body">

                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Batch</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->attendance_date->format('d M Y') }}</td>

                                <td>{{ optional($attendance->batch)->batch_name ?? '-' }}</td>

                                <td>{{ optional($attendance->subject)->subject_name ?? '-' }}</td>

                                <td>
                                    <span
                                        class="badge bg-{{ $attendance->status == 'present' ? 'success' : ($attendance->status == 'late' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $attendance->start_time ?? '-' }} - {{ $attendance->end_time ?? '-' }}
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No attendance records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $attendances->links() }}

            </div>
        </div>

    </main>
@endsection
