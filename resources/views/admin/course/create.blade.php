@extends('layouts.admin')

@push('title')
    Create Course
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Create Course
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Create New Course</h5>
                        <hr>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="row g-3" action="{{ route('admin.courses.store') }}" method="POST">
                            @csrf

                            <!-- COURSE BASIC INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">COURSE INFORMATION</h6>
                                </div>

                                <div class="card-body row g-3">

                                    <div class="col-6">
                                        <label class="form-label">Course Name</label>
                                        <input type="text" name="course_name" class="form-control"
                                            placeholder="e.g. Web Development" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Course Code</label>
                                        <input type="text" name="course_code" class="form-control"
                                            placeholder="e.g. WD-101" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Course Type</label>
                                        <select name="course_type_id" class="form-select" required>
                                            <option disabled selected>Select</option>
                                            @foreach ($courseTypes as $type)
                                                <option value="{{ $type->id }}">
                                                    {{ $type->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Course Fee</label>
                                        <input type="number" name="course_fee" class="form-control"
                                            placeholder="e.g. 25000">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Duration</label>
                                        <input type="number" name="duration" class="form-control" placeholder="e.g. 6">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Duration Type</label>
                                        <select name="duration_type" class="form-select">
                                            <option disabled selected>Select</option>
                                            <option value="weeks">Weeks</option>
                                            <option value="months">Months</option>
                                            <option value="years">Years</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="3" placeholder="Course description..."></textarea>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save Course
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
                            <li>Course code must be unique</li>
                            <li>Use clear course names</li>
                            <li>Deactivate old courses instead of deleting</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
