@extends('layouts.admin')

@push('title')
    Student Attendance
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Student Attendance
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12">

        {{-- Filters --}}
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.student-attendance.index') }}">
                    <div class="row g-3 align-items-end">

                        <div class="col-md-3">
                            <label class="form-label">Student</label>
                            <select name="student_id" class="form-select">
                                <option value="">All Students</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}"
                                        {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Batch</label>
                            <select name="batch_id" class="form-select">
                                <option value="">All Batches</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->batch_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Date</label>
                            <input type="date"
                                   name="date"
                                   value="{{ request('date') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button class="btn btn-primary w-100">
                                Filter
                            </button>

                            <a href="{{ route('admin.student-attendance.index') }}"
                               class="btn btn-outline-secondary w-100">
                                Reset
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- Attendance Table --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Attendance Records</h5>
                <a href="{{ route('admin.student-attendance.create') }}"
                   class="btn btn-sm btn-success">
                    + Mark Attendance
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Batch</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($attendances as $index => $attendance)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <strong>{{ $attendance->student->full_name }}</strong><br>
                                    <small class="text-muted">
                                        {{ $attendance->student->email ?? '' }}
                                    </small>
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $attendance->batch->batch_code }}
                                    </span>
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                                </td>

                                <td>
                                    @php
                                        $statusColors = [
                                            'present' => 'success',
                                            'absent' => 'danger',
                                            'late' => 'warning',
                                            'excused' => 'secondary',
                                            'cancelled' => 'dark',
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $statusColors[$attendance->status] ?? 'primary' }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $attendance->remarks ?? '-' }}
                                </td>
                                <td>
                               <a href="{{ route('admin.student-attendance.edit', [$attendance->batch_id, $attendance->attendance_date]) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                               <a href="{{ route('admin.student-attendance.delete', [$attendance->batch_id, $attendance->attendance_date]) }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No attendance records found
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
`
    </div>
</div>

</main>
@endsection
