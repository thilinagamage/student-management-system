@extends('layouts.admin')

@push('title')
    Subjects
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Subjects
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="mb-0">Subjects List</h5>
                    <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
                        + Add Subject
                    </a>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <th>Subject Code</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subject->subject_name }}</td>
                                    <td>{{ $subject->subject_code }}</td>
                                    <td>{{ $subject->course->course_name ?? '-' }}</td>
                                    <td>
                                        @if($subject->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="{{ route('admin.subjects.view',$subject->id) }}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                        <a href="{{ route('admin.subjects.edit',$subject->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="{{ route('admin.subjects.delete',$subject->id) }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        No subjects found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- Pagination (optional) --}}
                @if(method_exists($subjects, 'links'))
                    <div class="mt-3">
                        {{ $subjects->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

</main>
@endsection
