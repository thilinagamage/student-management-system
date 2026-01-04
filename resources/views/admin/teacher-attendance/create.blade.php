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

                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-3">Mark Teacher Attendance</h5>

                        <!-- FILTER SECTION -->
                        <form method="GET" action="{{ route('admin.teacher-attendance.create') }}" class="row g-3 mb-4">

                            <div class="col-md-3">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Batch</label>
                                <select name="batch_id" class="form-select" required>
                                    <option value="">Select Batch</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}"
                                            {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                            {{ $batch->batch_name }} ({{ $batch->batch_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 align-self-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    Load
                                </button>
                            </div>
                        </form>

                        <!-- ATTENDANCE FORM -->
                        @if (isset($assignments) && count($assignments))
                            <form method="POST" action="{{ route('admin.teacher-attendance.store') }}">
                                @csrf

                                <input type="hidden" name="attendance_date" value="{{ request('date', date('Y-m-d')) }}">
                                <input type="hidden" name="batch_id" value="{{ request('batch_id') }}">

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Teacher</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assignments as $assignment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>
                                                        {{ $assignment->teacher->full_name }}
                                                        <input type="hidden"
                                                            name="attendance[{{ $assignment->id }}][teacher_id]"
                                                            value="{{ $assignment->teacher_id }}">
                                                        <input type="hidden"
                                                            name="attendance[{{ $assignment->id }}][subject_id]"
                                                            value="{{ $assignment->subject_id }}">
                                                    </td>

                                                    <td>{{ $assignment->subject->subject_name }}</td>

                                                    <td>
                                                        <select name="attendance[{{ $assignment->id }}][status]"
                                                            class="form-select form-select-sm">
                                                            <option value="present">Present</option>
                                                            <option value="absent">Absent</option>
                                                            <option value="late">Late</option>
                                                            <option value="cancelled">Cancelled</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input type="time"
                                                            name="attendance[{{ $assignment->id }}][start_time]"
                                                            class="form-control form-control-sm">
                                                    </td>

                                                    <td>
                                                        <input type="time"
                                                            name="attendance[{{ $assignment->id }}][end_time]"
                                                            class="form-control form-control-sm">
                                                    </td>

                                                    <td>
                                                        <input type="text"
                                                            name="attendance[{{ $assignment->id }}][remarks]"
                                                            class="form-control form-control-sm" placeholder="Optional">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-success px-4">
                                        Save Attendance
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info mb-0">
                                Select a date and batch to mark attendance.
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
