@extends('layouts.admin')

@push('title')
    Edit Student Enrollment
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Edit Student Enrollment
        @endpush
        @include('components.admin.breadcumb')

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Student Enrollment</h5>

                        <a href="{{ route('admin.student-enrollment.index') }}" class="btn btn-sm btn-outline-secondary">
                            Back
                        </a>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.student-enrollment.update', $student->id) }}">
                            @csrf



                            <div class="mb-3">
                                <label class="form-label">Student</label>
                                <input type="text" class="form-control"
                                    value="{{ $student->full_name }} ({{ $student->email }})" disabled>
                            </div>


                            <div class="mb-4">
                                <label class="form-label">
                                    Assign Batches
                                    <small class="text-muted">(Multiple allowed)</small>
                                </label>

                                <select name="batch_ids[]" class="form-select" multiple required>

                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}"
                                            {{ $student->batches->contains($batch->id) ? 'selected' : '' }}>
                                            {{ $batch->batch_code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.student-enrollment.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>

                                <button class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i>
                                    Update Enrollment
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
