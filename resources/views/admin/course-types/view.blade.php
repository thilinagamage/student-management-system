@extends('layouts.admin')

@push('title')
    View Course Type
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            View Course Type
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Course Type Details</h5>
                        <hr>

                        <!-- Course Type Name -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Course Type Name</label>
                            <p class="form-control-plaintext">
                                {{ $courseType->type_name }}
                            </p>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <p class="form-control-plaintext">
                                {{ $courseType->description ?? '-' }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p>
                                @if ($courseType->status === 'active')
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
                                {{ $courseType->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated</label>
                            <p class="form-control-plaintext">
                                {{ $courseType->updated_at->format('d M Y, h:i A') }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.course-types.edit', $courseType->id) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <a href="{{ route('admin.course-types.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
