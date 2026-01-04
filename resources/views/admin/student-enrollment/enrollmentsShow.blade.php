@extends('layouts.admin')

@push('title')
    Course Enrollments
@endpush

@section('content')
    <main class="page-content">

        @include('components.admin.breadcumb', ['title' => 'Course Enrollments'])

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>Enrolled On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $index => $enrollment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $enrollment->student->full_name }}</td>
                                <td>{{ $enrollment->course->course_name }}</td>
                                <td>{{ $enrollment->batch->batch_code }}</td>
                                <td>{{ $enrollment->created_at->format('d M, Y') }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $enrollment->status == 'pending' ? 'warning' : ($enrollment->status == 'approved' ? 'success' : 'danger') }}">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($enrollment->isPending())
                                        <form method="POST" action="{{ route('admin.enrollments.approve', $enrollment) }}"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.enrollments.cancel', $enrollment) }}"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Cancel</button>
                                        </form>
                                    @else
                                        <span class="text-muted">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
