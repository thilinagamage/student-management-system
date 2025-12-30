@extends('layouts.admin')

@push('title')
    My Profile
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Profile
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <!-- PROFILE CARD -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src=""
                         class="rounded-circle p-1 bg-primary"
                         width="110" alt="profile">

                    <h5 class="mt-3 mb-1">{{ auth()->user()->username }}</h5>
                    <p class="text-muted mb-1 text-capitalize">
                        {{ auth()->user()->user_type }}
                    </p>
                    <p class="text-muted font-size-sm">
                        {{ auth()->user()->login_email }}
                    </p>
                </div>
            </div>
        </div>

        <!-- PROFILE UPDATE FORM -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Update Profile</h5>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text"
                                       name="username"
                                       class="form-control"
                                       value="{{ old('username', auth()->user()->username) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="login_email"
                                       class="form-control"
                                       value="{{ old('login_email', auth()->user()->login_email) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Leave blank to keep current">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                Update Profile
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</main>
@endsection
