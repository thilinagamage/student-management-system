@extends('layouts.admin')

@push('title')
    Edit Attendance
@endpush

@section('content')
    <main class="page-content">
        @include('components.admin.breadcumb', ['title' => 'Edit Attendance'])

        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Edit Your Attendance</h5>

                <form method="POST" action="{{ route('teacher.teacher-attendance.update', $attendance->id) }}">
                    @csrf



                    <div class="mb-3">
                        <label class="form-label">Batch</label>
                        <input type="text" class="form-control" value="{{ $attendance->batch->batch_name ?? '-' }}"
                            disabled>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" value="{{ $attendance->subject->subject_name ?? '-' }}"
                            disabled>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Attendance Date</label>
                        <input type="date" name="attendance_date" class="form-control"
                            value="{{ $attendance->attendance_date->format('Y-m-d') }}" required>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present
                            </option>
                            <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                            <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Late</option>
                            <option value="cancelled" {{ $attendance->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" value="{{ $attendance->start_time }}">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" value="{{ $attendance->end_time }}">
                    </div>

       
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control">{{ $attendance->remarks }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Attendance</button>
                    <a href="{{ route('teacher.teacher-attendance.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </main>
@endsection
