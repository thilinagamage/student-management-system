@extends('layouts.admin')

@section('content')
    <div class="container-fluid">


        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">My Batches</h4>
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Batch Name</th>
                                <th>Batch Code</th>
                                <th>Subjects</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($batches as $batch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>


                                    <td>
                                        {{ $batch->course->course_name ?? '-' }}
                                    </td>


                                    <td>{{ $batch->batch_name }}</td>
                                    <td>{{ $batch->batch_code }}</td>


                                    <td>
                                        @if ($batch->subjects->count())
                                            {{ $batch->subjects->pluck('subject_name')->implode(', ') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>


                                    <td>
                                        {{ optional($batch->start_date)->format('d M Y') ?? '-' }}
                                        <br>
                                        <small class="text-muted">
                                            to {{ optional($batch->end_date)->format('d M Y') ?? '-' }}
                                        </small>
                                    </td>


                                    <td>
                                        @if ($batch->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>


                                    <td class="text-center">
                                        <a href="{{ route('teacher.student-attendance.create', ['batch_id' => $batch->id]) }}"
                                            class="btn btn-sm btn-primary">
                                            Mark Attendance
                                        </a>

                                        <a href="{{ route('teacher.student-attendance.index', $batch->id) }}"
                                            class="btn btn-sm btn-outline-dark">
                                            View Attendance
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        No batches assigned to you
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
