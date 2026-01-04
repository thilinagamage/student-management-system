@extends('layouts.admin')

@section('title', 'Mark Attendance')

@section('content')
    <div class="page-content">


        <div class="page-breadcrumb d-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Attendance</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('teacher.dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Mark Attendance</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Mark Student Attendance</h5>
            </div>

            <div class="card-body">


                <form method="GET" action="{{ route('teacher.student-attendance.create') }}">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Select Batch</label>
                            <select name="batch_id" class="form-select" onchange="this.form.submit()" required>
                                <option value="">-- Select Batch --</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}"
                                        {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->batch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                @if (request('batch_id'))
                    <form action="{{ route('teacher.student-attendance.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="batch_id" value="{{ request('batch_id') }}">

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Attendance Date</label>
                                <input type="date" name="attendance_date" class="form-control"
                                    value="{{ now()->toDateString() }}" required>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Student ID</th>
                                        <th class="text-center">Present</th>
                                        <th class="text-center">Absent</th>
                                        <th class="text-center">Late</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $index => $student)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                            <td>{{ $student->student_code }}</td>
                                            <td class="text-center">
                                                <input type="radio" name="attendance[{{ $student->id }}]"
                                                    value="present" required>
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" name="attendance[{{ $student->id }}]"
                                                    value="absent">
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" name="attendance[{{ $student->id }}]"
                                                    value="late">
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No students found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                Save Attendance
                            </button>
                        </div>

                    </form>
                @endif


            </div>
        </div>

    </div>
@endsection
