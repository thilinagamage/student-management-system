@extends('layouts.admin')

@push('title')
    Edit Course
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Edit Course
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="mb-0">Edit Course</h5>
                    <hr>

                    <form class="row g-3"
                          action="{{ route('admin.courses.update', $course->id) }}"
                          method="POST">
                        @csrf
                        

                        <!-- COURSE BASIC INFORMATION -->
                        <div class="card shadow-none border mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">COURSE INFORMATION</h6>
                            </div>

                            <div class="card-body row g-3">

                                <div class="col-6">
                                    <label class="form-label">Course Name</label>
                                    <input type="text"
                                           name="course_name"
                                           class="form-control"
                                           value="{{ old('course_name', $course->course_name) }}"
                                           required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Course Code</label>
                                    <input type="text"
                                           name="course_code"
                                           class="form-control"
                                           value="{{ old('course_code', $course->course_code) }}"
                                           required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Course Type</label>
                                    <select name="course_type_id" class="form-select" required>
                                        @foreach($courseTypes as $type)
                                            <option value="{{ $type->id }}"
                                                {{ $course->course_type_id == $type->id ? 'selected' : '' }}>
                                                {{ $type->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Course Fee</label>
                                    <input type="number"
                                           name="course_fee"
                                           class="form-control"
                                           value="{{ old('course_fee', $course->course_fee) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Duration</label>
                                    <input type="number"
                                           name="duration"
                                           class="form-control"
                                           value="{{ old('duration', $course->duration) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Duration Type</label>
                                    <select name="duration_type" class="form-select">
                                        <option value="">Select</option>
                                        <option value="weeks"  {{ $course->duration_type == 'weeks' ? 'selected' : '' }}>Weeks</option>
                                        <option value="months" {{ $course->duration_type == 'months' ? 'selected' : '' }}>Months</option>
                                        <option value="years"  {{ $course->duration_type == 'years' ? 'selected' : '' }}>Years</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description"
                                              class="form-control"
                                              rows="3">{{ old('description', $course->description) }}</textarea>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active"   {{ $course->status == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $course->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                Update Course
                            </button>

                            <a href="{{ route('admin.courses.view', $course->id) }}"
                               class="btn btn-secondary">
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
                    <h6>Edit Tips</h6>
                    <ul class="text-secondary mb-0">
                        <li>Course code must remain unique</li>
                        <li>Deactivate instead of deleting</li>
                        <li>Changes affect future batches</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
