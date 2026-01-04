@extends('layouts.admin')

@push('title')
    View Attendance
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Attendance Records
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Attendance Records</h5>


                        <form action="{{ route('teacher.student-attendance.index') }}" method="GET" class="row g-3 mb-3">
                            <div class="col-md-4">
                                <select class="form-select" name="batch_id">
                                    <option value="">Select Batch</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}"
                                            {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                            {{ $batch->batch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="attendance_date" class="form-control"
                                    value="{{ request('attendance_date') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Batch</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($attendances as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendance->student->student_id }}</td>
                                            <td>{{ $attendance->student->first_name . ' ' . $attendance->student->last_name }}
                                            </td>
                                            <td>{{ $attendance->batch->batch_name ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M, Y') }}
                                            </td>
                                            <td>
                                                @php $status = strtolower($attendance->status); @endphp

                                                @if ($status === 'present')
                                                    <span class="badge bg-success">Present</span>
                                                @elseif($status === 'absent')
                                                    <span class="badge bg-danger">Absent</span>
                                                @elseif($status === 'late')
                                                    <span class="badge bg-warning text-dark">Late</span>
                                                @elseif($status === 'excused')
                                                    <span class="badge bg-secondary">Excused</span>
                                                @else
                                                    <span class="badge bg-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex gap-2 justify-content-center">

                                                    <a href="{{ route('teacher.student-attendance.edit', [$attendance->batch_id, $attendance->attendance_date]) }}"
                                                        class="text-warning" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Edit">
                                                        <i class="bi bi-pencil-fill"></i></a>

                                                    <a href="{{ route('teacher.student-attendance.delete', $attendance->id) }}"
                                                        class="text-danger" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Delete"><i
                                                            class="bi bi-trash-fill"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No attendance records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $attendances->links('pagination::bootstrap-5') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
