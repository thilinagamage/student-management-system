@extends('layouts.admin')

@push('title')
    My Enrollments
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            My Enrollments
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12">

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">My Enrollments</h5>
                    </div>

                    <div class="card-body">
                        @if ($enrollments->isEmpty())
                            <p>You have not enrolled in any course yet.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course</th>
                                        <th>Batch</th>
                                        <th>Enrolled On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($enrollments as $index => $enrollment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $enrollment->course->course_name ?? 'N/A' }}</td>
                                            <td>{{ $enrollment->batch->batch_name ?? 'N/A' }}</td>
                                            <td>{{ optional($enrollment->enrolled_date)->format('d M, Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $enrollment->status == 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            You have not enrolled in any course yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
