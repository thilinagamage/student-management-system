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

<div class="card">
    <div class="card-body">

        <!-- 🔹 Select Batch -->
        <form method="GET" class="row mb-4">
            <div class="col-md-4">
                <label class="form-label">Select Batch</label>
                <select name="batch_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Select Batch --</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}"
                            {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                            {{ $batch->batch_code }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if($students)
        <!-- 🔹 Attendance Form -->
        <form method="POST" action="{{ route('admin.student-attendance.store') }}">
            @csrf

            <input type="hidden" name="batch_id" value="{{ request('batch_id') }}">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Attendance Date</label>
                    <input type="date"
                           name="attendance_date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Student</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>
                                {{ $student->full_name }}
                                <input type="hidden"
                                       name="attendance[{{ $student->id }}][student_id]"
                                       value="{{ $student->id }}">
                            </td>

                            <td>
                                <select name="attendance[{{ $student->id }}][status]"
                                        class="form-select"
                                        required>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Late</option>
                                    <option value="excused">Excused</option>
                                </select>
                            </td>

                            <td>
                                <input type="text"
                                       name="attendance[{{ $student->id }}][remarks]"
                                       class="form-control"
                                       placeholder="Optional">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <button class="btn btn-success px-4">
                    <i class="bx bx-save"></i> Save Attendance
                </button>
            </div>

        </form>
        @endif

    </div>
</div>

</main>
@endsection
