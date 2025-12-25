@extends('layouts.admin')

@push('title')
    Teacher Assignments
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Teacher Assignments
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Teacher Assignments</h5>

                    <a href="{{ route('admin.teacher-assignments.create') }}"
                       class="btn btn-primary">
                        Assign Teacher
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Batch</th>
                                <th>Course</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Status</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $assignment->batch->batch_name }}
                                </td>

                                <td>
                                    {{ $assignment->batch->course->course_name }}
                                </td>

                                <td>
                                    {{ $assignment->subject->subject_name }}
                                </td>

                                <td>
                                    {{ $assignment->teacher->full_name ?? $assignment->teacher->name }}
                                </td>

                                <td>
                                    <span class="badge 
                                        {{ $assignment->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($assignment->status) }}
                                    </span>
                                </td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('admin.teacher-assignments.edit',$assignment->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="{{ route('admin.teacher-assignments.delete',$assignment->id) }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                        </div>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No teacher assignments found
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
