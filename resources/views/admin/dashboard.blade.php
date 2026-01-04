@extends('layouts.admin')

@push('title')
    Admin Dashboard
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Dashboard
        @endpush
        @include('components.admin.breadcumb')


        <div class="row g-3 mb-4">

            <div class="col-xl-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-primary text-white me-3">
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Students</h6>
                            <h4 class="mb-0">{{ $totalStudents }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-success text-white me-3">
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Teachers</h6>
                            <h4 class="mb-0">{{ $totalTeachers }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-warning text-white me-3">
                            <i class="bi bi-diagram-3 fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Total Batches</h6>
                            <h4 class="mb-0">{{ $totalBatches }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-box bg-danger text-white me-3">
                            <i class="bi bi-calendar-check fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Today Attendance</h6>
                            <h4 class="mb-0">{{ $todayAttendanceCount }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Student Attendance</h5>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Student</th>
                                    <th>Batch</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAttendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->attendance_date->format('d M Y') }}</td>
                                        <td>{{ $attendance->student->full_name ?? '-' }}</td>
                                        <td>{{ optional($attendance->batch)->batch_name ?? '-' }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $attendance->status == 'present' ? 'success' : ($attendance->status == 'late' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            No attendance records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

          
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body d-grid gap-2">

                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-people me-1"></i> Manage Students
                        </a>

                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-success">
                            <i class="bi bi-person-badge me-1"></i> Manage Teachers
                        </a>

                        <a href="{{ route('admin.batches.index') }}" class="btn btn-outline-warning">
                            <i class="bi bi-diagram-3 me-1"></i> Manage Batches
                        </a>

                        <a href="{{ route('admin.student-attendance.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-calendar-check me-1"></i> Attendance
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
