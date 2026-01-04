@extends('layouts.admin')

@push('title')
    Edit Admin
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Edit Admin
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-4">Edit Admin Details</h5>

                    <form action="{{ route('admin.admins.update', $admin->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        
                        <div class="text-center mb-4">
                            <img src="{{ $admin->profile_image
                                    ? asset('storage/' . $admin->profile_image)
                                    : asset('images/default-avatar.png') }}"
                                 class="rounded-circle p-1 bg-primary"
                                 width="120"
                                 alt="profile">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">First Name *</label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name', $admin->first_name) }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   value="{{ old('last_name', $admin->last_name) }}">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Username *</label>
                            <input type="text"
                                   name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username', $admin->username) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Login Email *</label>
                            <input type="email"
                                   name="login_email"
                                   class="form-control @error('login_email') is-invalid @enderror"
                                   value="{{ old('login_email', $admin->login_email) }}">
                            @error('login_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone', $admin->phone) }}">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Change Profile Image</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Role *</label>
                            <select name="role_level" class="form-select">
                                <option value="admin"
                                    {{ $admin->role_level === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                                <option value="super_admin"
                                    {{ $admin->role_level === 'super_admin' ? 'selected' : '' }}>
                                    Super Admin
                                </option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Leave blank to keep current password">
                        </div>


                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control">
                        </div>


                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">
                                Update Admin
                            </button>
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">
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
