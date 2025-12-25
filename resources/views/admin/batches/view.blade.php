@extends('layouts.admin')

@push('title')
Batch Details
@endpush

@section('content')
<main class="page-content">

@include('components.admin.breadcumb')

<div class="row">

  <!-- BATCH INFO -->
  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <h6 class="mb-0">Batch Information</h6>
      </div>
      <div class="card-body">

        <p><strong>Batch Name:</strong> {{ $batch->batch_name }}</p>
        <p><strong>Batch Code:</strong> {{ $batch->batch_code }}</p>
        <p><strong>Status:</strong>
          <span class="badge bg-success">
            {{ ucfirst($batch->status) }}
          </span>
        </p>

        <p><strong>Start Date:</strong>
          {{ $batch->start_date ? $batch->start_date->format('d M Y') : '-' }}
        </p>

        <p><strong>End Date:</strong>
          {{ $batch->end_date ? $batch->end_date->format('d M Y') : '-' }}
        </p>

      </div>
    </div>
  </div>

  <!-- COURSE INFO -->
  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-header">
        <h6 class="mb-0">Course Information</h6>
      </div>
      <div class="card-body">

        <p><strong>Course:</strong>
          {{ $batch->course->course_name ?? '-' }}
        </p>

        <p><strong>Course Code:</strong>
          {{ $batch->course->course_code ?? '-' }}
        </p>

        <p><strong>Duration:</strong>
          {{ $batch->course->duration }}
          {{ ucfirst($batch->course->duration_type) }}
        </p>

        <p><strong>Fee:</strong>
          Rs. {{ number_format($batch->course->course_fee) }}
        </p>

      </div>
    </div>
  </div>

</div>

<!-- SUBJECTS -->
<div class="row mt-3">
  <div class="col-12">
    <div class="card shadow-sm">
      <div class="card-header">
        <h6 class="mb-0">Subjects in This Batch</h6>
      </div>
      <div class="card-body p-0">

        <table class="table table-bordered mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Subject Name</th>
              <th>Code</th>
              <th>Status</th>
            </tr>
          </thead>
            <tbody>
            @forelse($batch->subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->subject_name }}</td>
                    <td>{{ $subject->subject_code }}</td>
                    <td>
                        <span class="badge bg-success">
                            {{ ucfirst($subject->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No subjects assigned to this batch
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

      </div>
    </div>
  </div>
</div>
<!-- TEACHER ASSIGNMENTS -->
<div class="card mt-3">
  <div class="card-header d-flex justify-content-between">
    <h6 class="mb-0">Teacher Assignments</h6>
    <a href="{{ route('teacher-assignments.create', ['batch_id' => $batch->id]) }}"
       class="btn btn-sm btn-primary">
       Assign Teacher
    </a>
  </div>

  <div class="card-body p-0">
    <table class="table table-bordered mb-0">
      <thead>
        <tr>
          <th>Subject</th>
          <th>Teacher</th>
        </tr>
      </thead>
      <tbody>
        @forelse($batch->teacherAssignments as $assign)
          <tr>
            <td>{{ $assign->subject->subject_name }}</td>
            <td>{{ $assign->teacher->full_name }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="2" class="text-center text-muted">
              No teachers assigned yet
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

</main>
@endsection
