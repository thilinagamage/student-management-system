@extends('layouts.admin')

@section('content')
    <main class="page-content">

        <h5>Add Course Type</h5>
        <hr>

        <form action="{{ route('admin.course-types.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Type Name</label>
                <input type="text" name="type_name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>

    </main>
@endsection
