@extends('layouts.admin')
@push('title')
    My Attendance
@endpush

@section('content')
    <main class="page-content">
        @include('components.admin.breadcumb', ['title' => 'My Attendance'])

        <div class="card">
            <div class="card-body">


                <form method="GET" class="row mb-4">
                    <div class="col-md-4">
                        <select name="batch_id" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Select Batch --</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}"
                                    {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->batch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <a href="{{ route('teacher.teacher-attendance.create') }}" class="btn btn-success mb-3">Mark Attendance</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->batch->batch_name ?? '-' }}</td>
                                <td>{{ $attendance->subject->subject_name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M, Y') }}</td>
                                <td>{{ ucfirst($attendance->status) }}</td>
                                <td>{{ $attendance->start_time ?? '-' }}</td>
                                <td>{{ $attendance->end_time ?? '-' }}</td>
                                <td>{{ $attendance->remarks ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('teacher.teacher-attendance.edit', $attendance->id) }}"
                                        class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Edit">
                                        <i class="bi bi-pencil-fill"></i></a>

                                    <a href="{{ route('teacher.teacher-attendance.delete', $attendance->id) }}"
                                        class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Delete"><i class="bi bi-trash-fill"></i></a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No attendance records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $attendances->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </main>
@endsection
