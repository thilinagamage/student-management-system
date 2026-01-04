@extends('layouts.admin')

@section('content')
    <main class="page-content">

        <div class="d-flex justify-content-between mb-3">
            <h5>Course Types</h5>
            <a href="{{ route('admin.course-types.create') }}" class="btn btn-primary">
                Add Course Type
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type Name</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courseTypes as $courseType)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $courseType->type_name }}</td>
                        <td>
                            <span class="badge bg-{{ $courseType->status == 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($courseType->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.course-types.view', $courseType->id) }}" class="text-primary"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i
                                    class="bi bi-eye-fill"></i></a>
                            <a href="{{ route('admin.course-types.edit', $courseType->id) }}" class="text-warning"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i
                                    class="bi bi-pencil-fill"></i></a>
                            <a href="{{ route('admin.course-types.delete', $courseType->id) }}" class="text-danger"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i
                                    class="bi bi-trash-fill"></i></a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </main>
@endsection
