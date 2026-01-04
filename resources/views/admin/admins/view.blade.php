@extends('layouts.admin')

@push('title')
    View Admin
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        View Admin
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-lg-4">
        
            <div class="card">
                <div class="card-body text-center">

                    <img src="{{ $admin->profile_image
                            ? asset('storage/' . $admin->profile_image)
                            : asset('images/default-avatar.png') }}"
                         class="rounded-circle p-1 bg-primary"
                         width="120"
                         alt="profile">

                    <h5 class="mt-3 mb-1">
                        {{ $admin->first_name }} {{ $admin->last_name }}
                    </h5>

                    <p class="text-muted mb-1">
                        {{ ucfirst(str_replace('_', ' ', $admin->role_level)) }}
                    </p>

                    <p class="text-muted font-size-sm">
                        {{ $admin->login_email }}
                    </p>

                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">

                    <h5 class="mb-4">Admin Information</h5>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">First Name</div>
                        <div class="col-md-8">{{ $admin->first_name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Last Name</div>
                        <div class="col-md-8">{{ $admin->last_name ?? '-' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Username</div>
                        <div class="col-md-8">{{ $admin->username }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Login Email</div>
                        <div class="col-md-8">{{ $admin->login_email }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Phone</div>
                        <div class="col-md-8">{{ $admin->phone ?? '-' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Role</div>
                        <div class="col-md-8">
                            <span class="badge bg-info text-dark">
                                {{ ucfirst(str_replace('_', ' ', $admin->role_level)) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Created At</div>
                        <div class="col-md-8">
                            {{ $admin->created_at->format('d M Y, h:i A') }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 fw-bold">Last Updated</div>
                        <div class="col-md-8">
                            {{ $admin->updated_at->format('d M Y, h:i A') }}
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.admins.edit', $admin->id) }}"
                           class="btn btn-primary">
                            Edit Admin
                        </a>

                        <a href="{{ route('admin.admins.index') }}"
                           class="btn btn-secondary">
                            Back to List
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
@endsection
