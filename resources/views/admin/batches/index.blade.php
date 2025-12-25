@extends('layouts.admin')

@push('title')
    Batches
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Batch List
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Batches</h5>
                        <a href="{{ route('admin.batches.create') }}"
                           class="btn btn-primary">
                            + Add Batch
                        </a>
                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Batch Name</th>
                                    <th>Batch Code</th>
                                    <th>Course</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Students</th>
                                    <th>Status</th>
                                    <th width="160">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($batches as $batch)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $batch->batch_name }}</td>

                                        <td>{{ $batch->batch_code }}</td>

                                        <td>
                                            {{ $batch->course->course_name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $batch->start_date
                                                ? \Carbon\Carbon::parse($batch->start_date)->format('d M Y')
                                                : '-' }}
                                        </td>

                                        <td>
                                            {{ $batch->end_date
                                                ? \Carbon\Carbon::parse($batch->end_date)->format('d M Y')
                                                : '-' }}
                                        </td>

                                        <td>
                                            {{ $batch->students_count ?? 0 }}
                                        </td>

                                        <td>
                                            @if($batch->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($batch->status == 'completed')
                                                <span class="badge bg-primary">Completed</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>

<td>
    <div class="table-actions d-flex align-items-center gap-3 fs-6">

        <a href="{{ route('admin.batches.view',$batch->id) }}"
           class="text-primary"
           data-bs-toggle="tooltip"
           title="View">
            <i class="bi bi-eye-fill"></i>
        </a>

        <a href="{{ route('admin.batches.edit',$batch->id) }}"
           class="text-warning"
           data-bs-toggle="tooltip"
           title="Edit">
            <i class="bi bi-pencil-fill"></i>
        </a>

        <!-- ASSIGN SUBJECTS -->
        <a href=""
           class="text-success"
           data-bs-toggle="tooltip"
           title="Assign Subjects">
            <i class="bi bi-journal-bookmark-fill"></i>
        </a>
        <a href=""
            class="btn btn-sm btn-info">
            Assign Teachers
            </a>


        <a href="{{ route('admin.batches.delete',$batch->id) }}"
           class="text-danger"
           data-bs-toggle="tooltip"
           title="Delete"
           onclick="return confirm('Are you sure?')">
            <i class="bi bi-trash-fill"></i>
        </a>

    </div>
</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            No batches found
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
@endsection
