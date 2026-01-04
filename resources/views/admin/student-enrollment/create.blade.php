@extends('layouts.admin')

@push('title')
    Student Enrollment
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Student Enrollment
        @endpush
        @include('components.admin.breadcumb')

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Enroll Student to Batch</h5>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.student-enrollment.store') }}">
                            @csrf

                            <div class="card">
                                <div class="card-body">


                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Student</label>
                                        <select name="student_id" class="form-select" required>
                                            <option value="">Select Student</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}">
                                                    {{ $student->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Assign Batches <small class="text-muted">(Multiple allowed)</small>
                                        </label>
                                        <select name="batch_ids[]" class="form-select" multiple required>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}">
                                                    {{ $batch->batch_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.student-enrollment.index') }}"
                                            class="btn btn-outline-secondary">
                                            Cancel
                                        </a>
                                        <button class="btn btn-primary">
                                            <i class="bi bi-person-plus"></i> Enroll Student
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
