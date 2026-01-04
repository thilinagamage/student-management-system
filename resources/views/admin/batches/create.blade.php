@extends('layouts.admin')

@push('title')
    Create Batch
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Create Batch
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">

          
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Create New Batch</h5>
                        <hr>

                        <form class="row g-3" action="{{ route('admin.batches.store') }}" method="POST">
                            @csrf

                            <!-- BATCH INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">BATCH INFORMATION</h6>
                                </div>

                                <div class="card-body row g-3">

                                    <div class="col-6">
                                        <label class="form-label">Batch Name</label>
                                        <input type="text" name="batch_name" class="form-control"
                                            placeholder="e.g. Batch 01" value="{{ old('batch_name') }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Batch Code</label>
                                        <input type="text" name="batch_code" class="form-control"
                                            placeholder="e.g. WD-B01" value="{{ old('batch_code') }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Course</label>
                                        <select name="course_id" class="form-select" required>
                                            <option disabled selected>Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Max Students</label>
                                        <input type="number" name="max_students" class="form-control" placeholder="e.g. 30"
                                            value="{{ old('max_students') }}">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control"
                                            value="{{ old('start_date') }}" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control"
                                            value="{{ old('end_date') }}">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save Batch
                                </button>
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
                            <li>Batch code must be unique</li>
                            <li>Select the correct course</li>
                            <li>Use status “Completed” for finished batches</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
