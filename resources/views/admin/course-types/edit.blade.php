@extends('layouts.admin')

@push('title')
    Edit Course Type
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Edit Course Type
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="mb-0">Edit Course Type</h5>
                        <hr>

                        <form action="{{ route('admin.course-types.update', $courseType->id) }}" method="POST">
                            @csrf


                            <!-- Course Type Name -->
                            <div class="mb-3">
                                <label class="form-label">Course Type Name</label>
                                <input type="text" name="type_name" class="form-control"
                                    value="{{ old('type_name', $courseType->type_name) }}" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $courseType->description) }}</textarea>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="active"
                                        {{ old('status', $courseType->status) == 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="inactive"
                                        {{ old('status', $courseType->status) == 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4">
                                    Update
                                </button>
                                <a href="{{ route('admin.course-types.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
