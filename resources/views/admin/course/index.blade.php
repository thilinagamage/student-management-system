@extends('layouts.admin')

@push('title')
    Courses
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Courses
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Course List</h5>
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                        + Add Course
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Course Code</th>
                                    <th>Course Type</th>
                                    <th>Duration</th>
                                    <th>Fee</th>
                                    <th>Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($courses as $course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $course->course_name }}</td>

                                        <td>{{ $course->course_code }}</td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ $course->courseType->type_name ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $course->duration }}
                                            {{ $course->duration_type }}
                                        </td>

                                        <td>
                                            @if($course->course_fee)
                                                Rs. {{ number_format($course->course_fee, 2) }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if($course->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.courses.edit', $course->id) }}"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form action=""
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            No courses found.
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
