@extends('layouts.admin')

@push('title')
    Assign Subjects
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Assign Subjects to Batch
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Assign Subjects</h5>
                        <hr>

                        <<form method="POST"
                            action="{{ route('admin.batches.assign-subjects.store', ['batch' => $batch->id]) }}">

                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Batch</label>
                                <input type="text" class="form-control" value="{{ $batch->batch_name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Subjects</label>

                                @foreach ($subjects as $subject)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="subjects[]"
                                            value="{{ $subject->id }}"
                                            {{ $batch->subjects->contains($subject->id) ? 'checked' : '' }}>

                                        <label class="form-check-label">
                                            {{ $subject->subject_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Save Assignments
                            </button>

                            <a href="{{ route('admin.batches.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                            </form>

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
