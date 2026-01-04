@extends('layouts.app')

@push('title')
    Login
@endpush

@section('content')
    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-0 overflow-hidden">
                        <div class="row g-0">

                            <!-- Left Image -->
                            <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/error/login-img.jpg') }}" class="img-fluid" alt="">
                            </div>

                            <!-- Login Form -->
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title">Sign In</h5>
                                    <p class="card-text mb-5">Login to continue your account</p>

                                    <form class="form-body" method="POST" action="{{ route('auth.login.check') }}">
                                        @csrf

                                        <!-- Google Login -->
                                        <div class="d-grid">
                                            <a class="btn btn-white radius-30" href="javascript:;">
                                                <span class="d-flex justify-content-center align-items-center">
                                                    <img class="me-2" src="{{ asset('assets/images/icons/search.svg') }}"
                                                        width="16" alt="">
                                                    <span>Sign in with Google</span>
                                                </span>
                                            </a>
                                        </div>

                                        <div class="login-separater text-center mb-4">
                                            <span>OR SIGN IN WITH EMAIL</span>
                                            <hr>
                                        </div>

                                        <div class="row g-3">

                                            <!-- Email -->
                                            <div class="col-12">
                                                <label class="form-label">Email Address</label>
                                                <div class="position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-envelope-fill"></i>
                                                    </div>
                                                    <input type="email" name="login_email"
                                                        class="form-control radius-30 ps-5" placeholder="Email Address"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Password -->
                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="position-relative">
                                                    <div
                                                        class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                        <i class="bi bi-lock-fill"></i>
                                                    </div>
                                                    <input type="password" name="password"
                                                        class="form-control radius-30 ps-5" placeholder="Enter Password"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Remember Me -->
                                            <div class="col-12 d-flex justify-content-between align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember">
                                                    <label class="form-check-label">Remember Me</label>
                                                </div>
                                                <a href="#" class="text-decoration-none">Forgot Password?</a>
                                            </div>

                                            <!-- Submit -->
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary radius-30">
                                                        Sign In
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Register Link -->
                                            <div class="col-12 text-center">
                                                <p class="mb-0">
                                                    Don’t have an account?
                                                    <a href="{{ route('auth.register') }}">Sign up here</a>
                                                </p>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
    <!--end wrapper-->
@endsection
