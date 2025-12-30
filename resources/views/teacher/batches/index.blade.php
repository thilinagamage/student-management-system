@extends('layouts.admin')

@section('title', 'My Batches')

@section('content')
<div class="page-content">

    <!-- Page Header -->
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">My Batches</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('teacher.dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        My Batches
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Batch List -->
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Batch Name</th>
                            <th>Course</th>
                            <th>Subject</th>
                            <th>Schedule</th>
                            <th>Status</th>
                            <th width="160">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($batches as $batch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $batch->name }}</td>
                                <td>{{ $batch->course->name ?? '-' }}</td>
                                <td>{{ $batch->subject->name ?? '-' }}</td>
                                <td>
                                    {{ $batch->day ?? '-' }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $batch->start_time ?? '' }} - {{ $batch->end_time ?? '' }}
                                    </small>
                                </td>
                                <td>
                                    @if ($batch->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href=""
                                       class="btn btn-sm btn-primary">
                                        View
                                    </a>

                                    <a href=""
                                       class="btn btn-sm btn-info">
                                        Students
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No batches assigned to you.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
