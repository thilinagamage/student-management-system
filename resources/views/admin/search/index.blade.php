@extends('layouts.admin')
@push('title')
    Add Student
@endpush
@section('content')
    <main class="page-content">


        <div class="row">
            <div class="container">
                <h5 class="mb-4">Search results for: <strong>{{ $q }}</strong></h5>

                {{-- Students --}}
                <div class="card mb-3">
                    <div class="card-header">Students</div>
                    <ul class="list-group list-group-flush">
                        @forelse($students as $student)
                            <li class="list-group-item">
                                {{ $student->first_name }} {{ $student->last_name }}
                                ({{ $student->student_id }})
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No students found</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Teachers --}}
                <div class="card mb-3">
                    <div class="card-header">Teachers</div>
                    <ul class="list-group list-group-flush">
                        @forelse($teachers as $teacher)
                            <li class="list-group-item">
                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No teachers found</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Batches --}}
                <div class="card mb-3">
                    <div class="card-header">Batches</div>
                    <ul class="list-group list-group-flush">
                        @forelse($batches as $batch)
                            <li class="list-group-item">
                                {{ $batch->batch_code }}
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No batches found</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

    </main>
@endsection
