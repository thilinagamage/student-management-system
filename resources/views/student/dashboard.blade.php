@extends('layouts.student')

@push('title')
    Student Dashboard
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Dashboard
        @endpush
        @include('components.admin.breadcumb')

        <div class="row mb-4">

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 text-center">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $student->profile_image) }}" class="rounded-circle mb-3" width="100"
                            height="100" alt="Student">

                        <h5 class="mb-1">{{ $student->full_name }}</h5>
                        <p class="text-muted mb-1">{{ $student->student_id }}</p>
                    </div>
                </div>
            </div>


            <div class="col-lg-8">
                <div class="row g-3">

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Total Classes</h6>
                                <h3 class="mb-0">{{ $totalClasses }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Present</h6>
                                <h3 class="text-success mb-0">{{ $presentCount }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h6 class="text-muted">Absent</h6>
                                <h3 class="text-danger mb-0">{{ $absentCount }}</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="mb-1">Today’s Attendance</h5>
                            <p class="text-muted mb-0">
                                {{ now()->format('d M Y') }}
                            </p>
                        </div>

                        <div>
                            @if ($todayAttendance)
                                <span
                                    class="badge fs-6 bg-{{ $todayAttendance->status == 'present'
                                        ? 'success'
                                        : ($todayAttendance->status == 'late'
                                            ? 'warning'
                                            : 'danger') }}">
                                    {{ ucfirst($todayAttendance->status) }}
                                </span>
                            @else
                                <span class="badge fs-6 bg-secondary">
                                    Not Marked
                                </span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Attendance</h5>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentAttendances as $attendance)
                                    <tr>
                                        <td>
                                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                                        </td>
                                        <td>
                                            {{ optional($attendance->subject)->subject_name ?? '-' }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $attendance->status == 'present' ? 'success' : ($attendance->status == 'late' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $attendance->start_time ?? '-' }} -
                                            {{ $attendance->end_time ?? '-' }}
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
                        <h5 class="mb-0">Quick Links</h5>
                    </div>
                    <div class="card-body d-grid gap-2">

                        <a href="{{ route('student.attendance.index') }}" class="btn btn-outline-primary">
                            View Attendance
                        </a>

                        <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                            My Profile
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
