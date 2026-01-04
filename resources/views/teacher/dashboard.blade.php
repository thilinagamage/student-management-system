@extends('layouts.admin')

@push('title')
    Teacher Dashboard
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Dashboard
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">

            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h6>Total Batches</h6>
                        <h2>{{ $totalBatches ?? 0 }}</h2>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h6>Total Students</h6>
                        <h2>{{ $totalStudents ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h6>Subjects</h6>
                        <h2>{{ $totalSubjects ?? 0 }}</h2>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h6>Today's Attendance</h6>
                        <h2>{{ optional($todayAttendance)->status ?? 'Not Marked' }}</h2>
                    </div>
                </div>
            </div>

        </div>


        <div class="card mt-4">
            <div class="card-header">
                <h5>Today's Classes</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Batch</th>
                            <th>Subjects</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($todayClasses as $class)
                            <tr>
                                <td>{{ $class->batch->batch_name }}</td>
                                <td>{{ $class->subject->subject_name }}</td>
                                <td>{{ $class->start_time ?? 'N/A' }} - {{ $class->end_time ?? 'N/A' }}</td>
                                <td><span class="badge bg-success">Scheduled</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No classes today</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
