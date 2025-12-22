@extends('layouts.admin')

@push('title')
    Update Batch
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Update Batch
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="mb-0">Update Batch</h5>
                    <hr>

                    <form class="row g-3"
                          action="{{ route('admin.batches.update', $batch->id) }}"
                          method="POST">
                        @csrf
                        

                        <!-- BATCH INFORMATION -->
                        <div class="card shadow-none border mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">BATCH INFORMATION</h6>
                            </div>

                            <div class="card-body row g-3">

                                <div class="col-6">
                                    <label class="form-label">Batch Name</label>
                                    <input type="text"
                                           name="batch_name"
                                           class="form-control"
                                           value="{{ old('batch_name', $batch->batch_name) }}"
                                           required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Batch Code</label>
                                    <input type="text"
                                           name="batch_code"
                                           class="form-control"
                                           value="{{ old('batch_code', $batch->batch_code) }}"
                                           required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Course</label>
                                    <select name="course_id" class="form-select" required>
                                        <option disabled>Select</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                {{ $batch->course_id == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Teacher</label>
                                    <select name="teacher_id" class="form-select">
                                        <option value="">Not Assigned</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ $batch->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Start Date</label>
                                    <input type="date"
                                           name="start_date"
                                           class="form-control"
                                           value="{{ old('start_date', $batch->start_date) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">End Date</label>
                                    <input type="date"
                                           name="end_date"
                                           class="form-control"
                                           value="{{ old('end_date', $batch->end_date) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="active" {{ $batch->status=='active'?'selected':'' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ $batch->status=='inactive'?'selected':'' }}>
                                            Inactive
                                        </option>
                                        <option value="completed" {{ $batch->status=='completed'?'selected':'' }}>
                                            Completed
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description"
                                              class="form-control"
                                              rows="3">{{ old('description', $batch->description) }}</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="text-start">
                            <button type="submit" class="btn btn-primary px-4">
                                Update Batch
                            </button>

                            <a href="{{ route('admin.batches.index') }}"
                               class="btn btn-secondary px-4 ms-2">
                                Back
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- SIDE INFO -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6>Batch Info</h6>
                    <ul class="text-secondary mb-0">
                        <li>Batch codes must be unique</li>
                        <li>Assign teacher later if unknown</li>
                        <li>Completed batches are read-only</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
