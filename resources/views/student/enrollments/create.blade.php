@extends('layouts.admin')

@push('title')
    Enroll Student
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Enroll Student
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">

                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Enroll Student</h5>

                        <a href="{{ route('admin.student-enrollment.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.student-enrollment.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="student_id" value="{{ auth()->id() }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Course <span class="text-danger">*</span>
                                </label>
                                <select name="course_id" id="course_id" class="form-select" required>
                                    <option value="">-- Select Course --</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Batch <span class="text-danger">*</span>
                                </label>
                                <select name="batch_id[]" id="batch_id" class="form-select" multiple required>
                                    <option value="">-- Select Batch --</option>
                                </select>
                                <small class="text-muted">
                                    Hold <b>Ctrl</b> (Windows) or <b>Cmd</b> (Mac) to select multiple batches
                                </small>
                                @error('batch_id')
                                    <br><small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Enrollment Date
                                </label>
                                <input type="date" name="enrollment_date" class="form-control"
                                    value="{{ now()->toDateString() }}">
                            </div>


                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-light">
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enroll Student
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
@push('scripts')
    <script>
        document.getElementById('course_id').addEventListener('change', function() {
            let courseId = this.value;
            let batchSelect = document.getElementById('batch_id');

            batchSelect.innerHTML = '<option value="">Loading...</option>';

            if (!courseId) {
                batchSelect.innerHTML = '';
                return;
            }

            fetch(`/admin/get-batches-by-course/${courseId}`)
                .then(response => response.json())
                .then(data => {
                    batchSelect.innerHTML = '';
                    data.forEach(batch => {
                        let option = document.createElement('option');
                        option.value = batch.id;
                        option.textContent = batch.batch_code;
                        batchSelect.appendChild(option);
                    });
                });
        });
    </script>
@endpush
