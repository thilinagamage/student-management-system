@extends('layouts.admin')

@push('title')
    Update Teacher
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Update Teacher
    @endpush
    @include('components.admin.breadcumb')

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-0">Update Teacher</h5>
                    <hr>

                    <!-- ✅ EDIT FORM -->
                    <form class="row g-3"
                        action="{{ route('admin.teachers.update', $teacher->id) }}" {{-- FIX --}}
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $teacher->id }}">

                        <!-- BASIC INFORMATION -->
                        <div class="card shadow-none border mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">BASIC INFORMATION</h6>
                            </div>
                            <div class="card-body row">
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name', $teacher->first_name) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name', $teacher->last_name) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select" name="gender">
                                        <option disabled>Select</option>
                                        <option value="male" {{ $teacher->gender=='male'?'selected':'' }}>Male</option>
                                        <option value="female" {{ $teacher->gender=='female'?'selected':'' }}>Female</option>
                                        <option value="other" {{ $teacher->gender=='other'?'selected':'' }}>Other</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control"
                                        value="{{ old('dob', $teacher->dob) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">NIC Number</label>
                                    <input type="text" name="nic_number" class="form-control"
                                        value="{{ old('nic_number', $teacher->nic_number) }}">
                                </div>
                            </div>
                        </div>

                        <!-- CONTACT INFORMATION -->
                        <div class="card shadow-none border mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">CONTACT INFORMATION</h6>
                            </div>
                            <div class="card-body row">
                                <div class="col-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', $teacher->phone) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $teacher->email) }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $teacher->address) }}">
                                </div>
                            </div>
                        </div>

                        <!-- PROFESSIONAL INFORMATION -->
                        <div class="card shadow-none border mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">PROFESSIONAL INFORMATION</h6>
                            </div>
                            <div class="card-body row">
                                <div class="col-6">
                                    <label class="form-label">Qualification</label>
                                    <input type="text" name="qualification" class="form-control"
                                        value="{{ old('qualification', $teacher->qualification) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Specialization</label>
                                    <input type="text" name="specialization" class="form-control"
                                        value="{{ old('specialization', $teacher->specialization) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Join Date</label>
                                    <input type="date" name="join_date" class="form-control"
                                        value="{{ old('join_date', $teacher->join_date) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="active" {{ $teacher->status=='active'?'selected':'' }}>Active</option>
                                        <option value="inactive" {{ $teacher->status=='inactive'?'selected':'' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- SYSTEM ACCOUNT -->
                        <div class="card shadow-none border mb-3">
                            <div class="card-header">
                                <h6 class="mb-0">SYSTEM ACCOUNT</h6>
                            </div>
                            <div class="card-body row">
                                <div class="col-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control"
                                        value="{{ $teacher->username }}" readonly>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Login Email</label>
                                    <input type="email" name="login_email" class="form-control"
                                        value="{{ old('login_email', $teacher->login_email) }}">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="text-start">
                            <button type="submit" class="btn btn-primary px-4">
                                Update Teacher
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- PROFILE PREVIEW -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body text-center">

                    @if($teacher->profile_image)
                        <img src="{{ asset('storage/'.$teacher->profile_image) }}"
                            width="120" height="120" style="border-radius:50%">
                    @else
                        <img src="{{ asset('assets/images/default-avatar.png') }}"
                            width="120" height="120">
                    @endif

                    <h4 class="mt-3">{{ $teacher->first_name }} {{ $teacher->last_name }}</h4>
                    <p class="text-secondary mb-1">{{ $teacher->specialization }}</p>
                    <p class="text-secondary">{{ $teacher->address }}</p>

                    <hr>

                    <h6>Phone</h6>
                    <p>{{ $teacher->phone_number }}</p>

                    <h6>Email</h6>
                    <p>{{ $teacher->email }}</p>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
