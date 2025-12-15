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
            @foreach($courseTypes as $type)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $type->type_name }}</td>
                <td>
                    <span class="badge bg-{{ $type->status=='active'?'success':'danger' }}">
                        {{ ucfirst($type->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.course-types.edit',$type->id) }}"
                       class="btn btn-sm btn-warning">Edit</a>

                    <form action=""
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this course type?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</main>
@endsection
