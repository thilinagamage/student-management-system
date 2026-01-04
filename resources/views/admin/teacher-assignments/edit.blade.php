@extends('layouts.admin')

@push('title')
    Edit Teacher Assignment
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Edit Teacher Assignment
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">

                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Edit Teacher Assignment</h5>
                        <hr>

                        <form class="row g-3" action="{{ route('admin.teacher-assignments.update', $assignment->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')


                            <!-- ASSIGNMENT INFO -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">ASSIGNMENT DETAILS</h6>
                                </div>

                                <div class="card-body row g-3">

                                    <!-- COURSE (READ ONLY) -->
                                    <div class="col-6">
                                        <label class="form-label">Course</label>
                                        <input type="text" class="form-control"
                                            value="{{ $assignment->batch->course->course_name }}" readonly>
                                    </div>

                                    <!-- BATCH (READ ONLY) -->
                                    <div class="col-6">
                                        <label class="form-label">Batch</label>
                                        <input type="text" class="form-control"
                                            value="{{ $assignment->batch->batch_name }}" readonly>
                                    </div>

                                    <!-- SUBJECT (READ ONLY) -->
                                    <div class="col-6">
                                        <label class="form-label">Subject</label>
                                        <input type="text" class="form-control"
                                            value="{{ $assignment->subject->subject_name }}" readonly>
                                    </div>

                                    <!-- TEACHER -->
                                    <div class="col-6">
                                        <label class="form-label">Teacher</label>
                                        <select name="teacher_id" class="form-select" required>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    {{ $teacher->id == $assignment->teacher_id ? 'selected' : '' }}>
                                                    {{ $teacher->full_name ?? $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- STATUS -->
                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" {{ $assignment->status === 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive"
                                                {{ $assignment->status === 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">
                                    Update Assignment
                                </button>

                                <a href="{{ route('admin.teacher-assignments.index') }}" class="btn btn-secondary ms-2">
                                    Cancel
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
