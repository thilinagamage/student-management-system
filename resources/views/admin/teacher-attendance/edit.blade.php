@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Teacher Attendance</h4>

    <form action="{{ route('admin.teacher-attendance.update', [
                    'batch' => $attendance->batch_id,
                    'date'  => $attendance->attendance_date
                ]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- Teacher -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Teacher</label>
                <select class="form-select" disabled>
                    <option>{{ $attendance->teacher->first_name }} {{ $attendance->teacher->last_name }}</option>
                </select>
            </div>

            <!-- Batch -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Batch</label>
                <select class="form-select" disabled>
                    <option>{{ $attendance->batch->batch_name }}</option>
                </select>
            </div>

            <!-- Subject -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Subject</label>
                <select class="form-select" disabled>
                    <option>{{ $attendance->subject->subject_name }}</option>
                </select>
            </div>

            <!-- Attendance Date -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Attendance Date</label>
                <input type="date"
                       class="form-control"
                       value="{{ $attendance->attendance_date }}"
                       disabled>
            </div>

            <!-- Status -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="present"   {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent"    {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                    <option value="late"      {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                    <option value="cancelled" {{ $attendance->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Start Time -->
            <div class="col-md-4 mb-3">
                <label class="form-label">Start Time</label>
                <input type="time"
                       name="start_time"
                       class="form-control"
                       value="{{ $attendance->start_time }}">
            </div>

            <!-- End Time -->
            <div class="col-md-4 mb-3">
                <label class="form-label">End Time</label>
                <input type="time"
                       name="end_time"
                       class="form-control"
                       value="{{ $attendance->end_time }}">
            </div>

            <!-- Remarks -->
            <div class="col-md-8 mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks"
                          class="form-control"
                          rows="3">{{ $attendance->remarks }}</textarea>
            </div>

        </div>

        <div class="mt-3">
            <button class="btn btn-primary">Update Attendance</button>
            <a href="{{ route('admin.teacher-attendance.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

    </form>
</div>
@endsection
