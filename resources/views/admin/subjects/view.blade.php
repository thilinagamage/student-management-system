@extends('layouts.admin')

@push('title')
    View Subject
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    View Subject
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5 class="mb-0">Subject Details</h5>
                <hr>

                <!-- SUBJECT INFORMATION -->
                <div class="card shadow-none border mb-3">
                    <div class="card-header">
                        <h6 class="mb-0">SUBJECT INFORMATION</h6>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Subject Name</label>
                            <p class="form-control-plaintext">
                                {{ $subject->subject_name }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Subject Code</label>
                            <p class="form-control-plaintext">
                                {{ $subject->subject_code }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Course</label>
                            <p class="form-control-plaintext">
                                {{ $subject->course->course_name ?? '-' }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-{{ $subject->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($subject->status) }}
                                </span>
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Created At</label>
                            <p class="form-control-plaintext">
                                {{ $subject->created_at?->format('d M Y, h:i A') ?? '-' }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated</label>
                            <p class="form-control-plaintext">
                                {{ $subject->updated_at?->format('d M Y, h:i A') ?? '-' }}
                            </p>
                        </div>

                        <!-- ACTIONS -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                               class="btn btn-warning">
                                Edit
                            </a>

                            <a href="{{ route('admin.subjects.index') }}"
                               class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- INFO PANEL -->
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Information</h6>
                <ul class="text-secondary mb-0">
                    <li>Subjects belong to courses</li>
                    <li>Inactive subjects won’t appear in batches</li>
                    <li>Use Edit to modify details</li>
                </ul>
            </div>
        </div>
    </div>

</div>

</main>
@endsection
