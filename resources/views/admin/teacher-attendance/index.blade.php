@extends('layouts.admin')

@push('title')
    Mark Teacher Attendance
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Mark Teacher Attendance
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12">


<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Teacher Attendance</h4>

        <a href="{{ route('admin.teacher-attendance.create') }}"
           class="btn btn-primary btn-sm">
            + Mark Attendance
        </a>
    </div>

    <!-- FILTER FORM -->
    <form method="GET" class="card mb-3">
        <div class="card-body">
            <div class="row g-2">

                <!-- Teacher -->
                <div class="col-md-4">
                    <label class="form-label">Teacher</label>
                    <select name="teacher_id" class="form-control">
                        <option value="">-- All Teachers --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                  {{ request('teacher_id') ? '' : 'disabled' }}>>
                                {{ $teacher->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Batch -->
                <div class="col-md-4">
                    <label class="form-label">Batch</label>
                    <select name="batch_id" class="form-control">
                        <option value="">-- All Batches --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}"
                                {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                {{ $batch->batch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="col-md-4">
                    <label class="form-label">Date</label>
                    <input type="date"
                           name="date"
                           value="{{ request('date') }}"
                           class="form-control">
                </div>

            </div>

            <div class="mt-3 d-flex gap-2">
                <button class="btn btn-secondary">
                    Filter
                </button>

                <a href="{{ route('admin.teacher-attendance.index') }}"
                   class="btn btn-light">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <!-- TABLE -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Teacher</th>
                        <th>Batch</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                            </td>

                            <td>{{ $attendance->teacher->full_name ?? '-' }}</td>

                            <td>{{ $attendance->batch->batch_name ?? '-' }}</td>

                            <td>{{ $attendance->subject->subject_name ?? '-' }}</td>

                            <td>
                                <span class="badge
                                    @if($attendance->status == 'present') bg-success
                                    @elseif($attendance->status == 'late') bg-warning
                                    @elseif($attendance->status == 'absent') bg-danger
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($attendance->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $attendance->start_time ?? '--' }} -
                                {{ $attendance->end_time ?? '--' }}
                            </td>

                            <td>{{ $attendance->remarks ?? '-' }}</td>

                            <td>
                                <a href="{{ route('admin.teacher-attendance.edit', $attendance->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</main>
@endsection
