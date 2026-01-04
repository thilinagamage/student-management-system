@extends('layouts.admin')

@push('title')
    View Course
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            View Course
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Course Details</h5>
                        <hr>

                        <!-- Course Name -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Name</label>
                            <p class="form-control-plaintext">
                                {{ $course->course_name }}
                            </p>
                        </div>

                        <!-- Course Code -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Code</label>
                            <p class="form-control-plaintext">
                                {{ $course->course_code }}
                            </p>
                        </div>

                        <!-- Course Type -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Type</label>
                            <p>
                                <span class="badge bg-info">
                                    {{ $course->courseType->type_name ?? 'N/A' }}
                                </span>
                            </p>
                        </div>

                        <!-- Duration -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Duration</label>
                            <p class="form-control-plaintext">
                                {{ $course->duration ?? '-' }}
                                {{ $course->duration_type }}
                            </p>
                        </div>

                        <!-- Course Fee -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Fee</label>
                            <p class="form-control-plaintext">
                                @if ($course->course_fee)
                                    Rs. {{ number_format($course->course_fee, 2) }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <p class="form-control-plaintext">
                                {{ $course->description ?? '-' }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p>
                                @if ($course->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                        </div>

                        <!-- Timestamps -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Created At</label>
                            <p class="form-control-plaintext">
                                {{ $course->created_at ? $course->created_at->format('d M Y, h:i A') : '-' }}

                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated</label>
                            <p class="form-control-plaintext">
                                {{ $course->updated_at ? $course->updated_at->format('d M Y, h:i A') : '-' }}

                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- SIDE CARD (OPTIONAL) -->
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="mb-3">Quick Info</h6>

                        <p><strong>Type:</strong> {{ $course->courseType->type_name ?? '-' }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($course->status) }}</p>
                        <p><strong>Fee:</strong>
                            {{ $course->course_fee ? 'Rs. ' . number_format($course->course_fee, 2) : '-' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
