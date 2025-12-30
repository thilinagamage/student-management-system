@extends('layouts.admin')

@push('title')
    Manage Admins
@endpush

@section('content')
<main class="page-content">

@push('breadcumb')
    Manage Admins
@endpush
@include('components.admin.breadcumb')

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="d-flex align-items-center">
                    <h5 class="mb-0">Admin Users</h5>

                    @if(auth()->user()->can('manage-admins'))
                        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                            + Create Admin
                        </a>
                    @endif


                    <form class="ms-auto position-relative" method="GET">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                            <i class="bi bi-search"></i>
                        </div>
                        <input class="form-control ps-5" type="text" name="search"
                               placeholder="Search admin..." value="{{ request('search') }}">
                    </form>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th width="160">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->login_email }}</td>
                                    <td>
                                        <span class="badge bg-dark">Admin</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $admin->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($admin->status) }}
                                        </span>
                                    </td>
                                    <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                                        <a href="{{ route('admin.admins.edit',$admin->id) }}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="{{ route('admin.admins.delete',$admin->id) }}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                                    </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No admins found</td>
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
