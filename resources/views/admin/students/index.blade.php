@extends('layouts.admin')
@push('title')
    Manage Student
@endpush
@section('content')
    <main class="page-content">
        @push('breadcumb')
            Manage Students
        @endpush
        @include('components.admin.breadcumb')


        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Customer Details</h5>
                            <form class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i
                                        class="bi bi-search"></i></div>
                                <input class="form-control ps-5" type="text" placeholder="search">
                            </form>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Course</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}
                                            </td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                    @if ($student->profile_image)
                                                        <img src="{{ asset('storage/' . $student->profile_image) }}"
                                                            width="50" height="50" style="border-radius:50%">
                                                    @else
                                                        <img src="{{ asset() }}" width="50" height="50">
                                                    @endif

                                            <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                                                </div>
                                            </td>
                                         <td>{{ $student->address }}</td>
                        <td>
                            @forelse($student->enrollments as $enrollment)
                                <span class="badge bg-primary">
                                    {{ $enrollment->course->course_name }}
                                </span>
                            @empty
                                <span class="text-muted">Not Enrolled</span>
                            @endforelse
                        </td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                <a href="{{ route('admin.students.view', $student->id) }}" class="text-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i
                                        class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('admin.students.edit', $student->id) }}" class="text-warning"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i
                                        class="bi bi-pencil-fill"></i></a>
                                <a href="{{ route('admin.students.delete', $student->id) }}" class="text-danger"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i
                                        class="bi bi-trash-fill"></i></a>
                            </div>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-3">
                            {{ $students->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection
