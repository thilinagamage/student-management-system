@extends('layouts.admin')

@push('title')
    Add Subject
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Add Subject
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Add Subject</h5>
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

                        <!-- SUBJECT FORM START -->
                        <form class="row g-3" action="{{ route('admin.subjects.store') }}" method="POST">
                            @csrf

                            <!-- SUBJECT INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">SUBJECT INFORMATION</h6>
                                </div>

                                <div class="card-body row g-3">

                                    <div class="col-6">
                                        <label class="form-label">Course</label>
                                        <select name="course_id" class="form-select" required>
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Subject Name</label>
                                        <input type="text" name="subject_name" class="form-control" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Subject Code</label>
                                        <input type="text" name="subject_code" class="form-control" required>
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" rows="3" class="form-control"></textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">
                                    Save Subject
                                </button>
                            </div>

                        </form>
                        <!-- SUBJECT FORM END -->

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
