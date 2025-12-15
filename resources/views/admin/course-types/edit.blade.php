@extends('layouts.admin')

@section('content')
<main class="page-content">

<h5>Edit Course Type</h5>
<hr>

<form action="{{ route('admin.course-types.update',$courseType->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Type Name</label>
        <input type="text" name="type_name"
               value="{{ $courseType->type_name }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $courseType->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="active" {{ $courseType->status=='active'?'selected':'' }}>Active</option>
            <option value="inactive" {{ $courseType->status=='inactive'?'selected':'' }}>Inactive</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

</main>
@endsection
