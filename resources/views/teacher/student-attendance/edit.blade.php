@extends('layouts.admin')

@push('title')
    Edit Attendance
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Edit Attendance
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-12">

                <div class="card">
                    <div class="card-body">


                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="mb-1">Edit Attendance</h5>
                                <small class="text-muted">
                                    Batch: <strong>{{ $batch->batch_name ?? $batch->batch_code }}</strong> |
                                    Date: <strong>{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</strong>
                                </small>
                            </div>

                            <a href="{{ route('admin.student-attendance.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bx bx-arrow-back"></i> Back
                            </a>
                        </div>


                        <form method="POST" action="{{ route('teacher.student-attendance.update', [$batch->id, $date]) }}">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                            <input type="hidden" name="attendance_date" value="{{ $date }}">

                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendances as $index => $attendance)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>
                                                    <strong>{{ $attendance->student->full_name }}</strong><br>
                                                    <small class="text-muted">
                                                        {{ $attendance->student->student_id }}
                                                    </small>
                                                </td>

                                                <td>
                                                    <select name="attendance[{{ $attendance->student_id }}][status]"
                                                        class="form-select" required>
                                                        <option value="present"
                                                            {{ $attendance->status == 'present' ? 'selected' : '' }}>
                                                            Present
                                                        </option>
                                                        <option value="absent"
                                                            {{ $attendance->status == 'absent' ? 'selected' : '' }}>
                                                            Absent
                                                        </option>
                                                        <option value="late"
                                                            {{ $attendance->status == 'late' ? 'selected' : '' }}>
                                                            Late
                                                        </option>
                                                        <option value="excused"
                                                            {{ $attendance->status == 'excused' ? 'selected' : '' }}>
                                                            Excused
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text"
                                                        name="attendance[{{ $attendance->student_id }}][remarks]"
                                                        class="form-control" value="{{ $attendance->remarks }}"
                                                        placeholder="Optional">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <div class="text-end mt-3">
                                <button class="btn btn-primary px-4">
                                    <i class="bx bx-save"></i> Update Attendance
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
