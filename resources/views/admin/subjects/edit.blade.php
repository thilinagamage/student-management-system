@extends('layouts.admin')

@push('title')
    Edit Subject
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Edit Subject
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Edit Subject</h5>
                        <hr>

                        <form class="row g-3" action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
                            @csrf


                            <!-- SUBJECT INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">SUBJECT INFORMATION</h6>
                                </div>

                                <div class="card-body row g-3">

                                    <div class="col-6">
                                        <label class="form-label">Subject Name</label>
                                        <input type="text" name="subject_name" class="form-control"
                                            value="{{ old('subject_name', $subject->subject_name) }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Subject Code</label>
                                        <input type="text" name="subject_code" class="form-control"
                                            value="{{ old('subject_code', $subject->subject_code) }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Course</label>
                                        <select name="course_id" class="form-select" required>
                                            <option disabled>Select</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ $course->id == $subject->course_id ? 'selected' : '' }}>
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" {{ $subject->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ $subject->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">
                                    Update Subject
                                </button>
                                <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary px-4">
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
                            <li>Subject code must be unique</li>
                            <li>Ensure correct course mapping</li>
                            <li>Deactivate instead of deleting if used</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
