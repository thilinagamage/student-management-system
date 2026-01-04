@extends('layouts.admin')

@push('title')
    Teacher Assignments
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Teacher Attendance Report
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12">
                <!-- 🔹 Filter Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Attendance</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3">

                            <div class="col-md-3">
                                <label class="form-label">Teacher</label>
                                <select name="teacher_id" class="form-select">
                                    <option value="">All Teachers</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Batch</label>
                                <select name="batch_id" class="form-select">
                                    <option value="">All Batches</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}"
                                            {{ request('batch_id') == $batch->id ? 'selected' : '' }}>
                                            {{ $batch->batch_code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">From Date</label>
                                <input type="date" name="from_date" value="{{ request('from_date') }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">To Date</label>
                                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                            </div>

                            <div class="col-12 text-end">
                                <button class="btn btn-primary px-4">
                                    <i class="bx bx-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.teacher-attendance.report') }}" class="btn btn-outline-secondary">
                                    Reset
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- 🔹 Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body text-success">
                                <h6>Present</h6>
                                <h3>{{ $summary['present'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body text-danger">
                                <h6>Absent</h6>
                                <h3>{{ $summary['absent'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body text-warning">
                                <h6>Late</h6>
                                <h3>{{ $summary['late'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body text-secondary">
                                <h6>Cancelled</h6>
                                <h3>{{ $summary['cancelled'] }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 text-end">
                    <a href="{{ route('admin.teacher-attendance.export.excel', request()->query()) }}"
                        class="btn btn-success">
                        <i class="bx bx-file"></i> Export Excel
                    </a>

                    <a href="{{ route('admin.teacher-attendance.export.pdf', request()->query()) }}"
                        class="btn btn-danger">
                        <i class="bx bx-file"></i> Export PDF
                    </a>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Monthly Attendance Summary</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Month</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Late</th>
                                    <th>Cancelled</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($monthlySummary as $row)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($row->month . '-01')->format('F Y') }}</td>
                                        <td class="text-success">{{ $row->present }}</td>
                                        <td class="text-danger">{{ $row->absent }}</td>
                                        <td class="text-warning">{{ $row->late }}</td>
                                        <td class="text-secondary">{{ $row->cancelled }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No monthly data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Teacher-wise Attendance Summary</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Teacher</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Late</th>
                                    <th>Cancelled</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teacherSummary as $row)
                                    <tr>
                                        <td>{{ $row->teacher->full_name ?? '-' }}</td>
                                        <td class="text-success">{{ $row->present }}</td>
                                        <td class="text-danger">{{ $row->absent }}</td>
                                        <td class="text-warning">{{ $row->late }}</td>
                                        <td class="text-secondary">{{ $row->cancelled }}</td>
                                        <td><strong>{{ $row->total }}</strong></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            No teacher summary data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 🔹 Attendance Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Attendance Records</h5>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Teacher</th>
                                    <th>Batch</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $row)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($row->attendance_date)->format('d M Y') }}</td>
                                        <td>{{ $row->teacher->full_name }}</td>
                                        <td>{{ $row->batch->batch_code ?? '-' }}</td>
                                        <td>{{ $row->subject->subject_name ?? '-' }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $row->status == 'present'
                                                    ? 'success'
                                                    : ($row->status == 'absent'
                                                        ? 'danger'
                                                        : ($row->status == 'late'
                                                            ? 'warning'
                                                            : 'secondary')) }}">
                                                {{ ucfirst($row->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $row->start_time ?? '-' }} - {{ $row->end_time ?? '-' }}
                                        </td>
                                        <td>{{ $row->remarks ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            No attendance records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
        </div>

    </main>
@endsection
