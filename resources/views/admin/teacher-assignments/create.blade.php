@extends('layouts.admin')

@push('title')
    Assign Teacher
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Assign Teacher to Subject
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12 col-lg-8">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5 class="mb-0">Assign Teacher</h5>
                <hr>

                <form class="row g-3"
                      action="{{ route('admin.teacher-assignments.store') }}"
                      method="POST">
                    @csrf

                    <!-- BATCH -->
                    <div class="col-12">
                        <label class="form-label">Batch</label>
                        <select name="batch_id" class="form-select" required>
                            <option value="">Select Batch</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">
                                    {{ $batch->batch_name }}
                                    ({{ $batch->course->course_name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- SUBJECT -->
                    <div class="col-12">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" class="form-select" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ $subject->subject_name }}
                                    ({{ $subject->subject_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- TEACHER -->
                    <div class="col-12">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" class="form-select" required>
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">
                                    {{ $teacher->full_name ?? $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- STATUS -->
                    <div class="col-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- ACTIONS -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4">
                            Assign Teacher
                        </button>

                        <a href="{{ route('admin.teacher-assignments.index') }}"
                           class="btn btn-light px-4">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- INFO PANEL -->
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6>Tips</h6>
                <ul class="text-secondary mb-0">
                    <li>Teacher is assigned per batch & subject</li>
                    <li>One teacher per subject per batch</li>
                    <li>Deactivate instead of deleting</li>
                </ul>
            </div>
        </div>
    </div>

</div>

</main>
@endsection
