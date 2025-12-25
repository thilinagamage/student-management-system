@extends('layouts.admin')

@push('title')
    Student Enrollment
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Student Enrollment
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12">

        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Student Enrollment</h5>

                <a href="{{ route('admin.student-enrollment.create') }}"
                   class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Enroll Student
                </a>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th style="width: 60px;">#</th>
                                <th class="text-start">Student</th>
                                <th>Enrolled Batches</th>
                                <th style="width: 150px;">Enrollment Date</th>
                                <th style="width: 160px;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($enrollments as $index => $student)
                                <tr>
                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        <strong>{{ $student->full_name }}</strong><br>
                                        <small class="text-muted">
                                            {{ $student->email }}
                                        </small>
                                    </td>

                                    <td>
                                        @forelse($student->batches as $batch)
                                            <span class="badge bg-info text-dark me-1 mb-1">
                                                {{ $batch->batch_code }}
                                            </span>
                                        @empty
                                            <span class="text-muted">No batches</span>
                                        @endforelse
                                    </td>

                                    <td class="text-center">
                                        {{ optional($student->batches->first()?->pivot)
                                            ->created_at?->format('d M Y') ?? '-' }}
                                    </td>

                                    <td class="text-center">
                              <a href="{{ route('admin.student-enrollment.edit', $student->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                              <a href="{{ route('admin.student-enrollment.delete', $student->id) }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-info-circle"></i>
                                        No student enrollments found
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
