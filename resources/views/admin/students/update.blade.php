@extends('layouts.admin')
@push('title')
    Add Student
@endpush
@section('content')
    <main class="page-content">
        @push('breadcumb')
            Add Student
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-0">Update Student</h5>
                        <hr>

                        <!-- SINGLE FORM START -->
                        <form class="row g-3" action="{{ route('admin.students.update', $student->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            <!-- USER INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">USER INFORMATION</h6>
                                </div>
                                <div class="card-body row">
                                    <div class="col-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ $student->first_name }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ $student->last_name }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select" name="gender">
                                            <option selected>Select</option>
                                            <option {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}
                                                value="male">Male</option>
                                            <option {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}
                                                value="female">Female</option>
                                            <option {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}
                                                value="female">Other</option>

                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ $student->dob }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Age</label>
                                        <input type="number" name="age" class="form-control"
                                            value="{{ $student->age }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">NIC Number</label>
                                        <input type="text" name="nic_number" class="form-control"
                                            value="{{ $student->nic_number }}">
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
                                            value="{{ $student->phone_number }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">WhatsApp Number</label>
                                        <input type="number" name="whatsapp_number" class="form-control"
                                            value="{{ $student->whatsapp_number }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $student->email }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $student->address }}">
                                    </div>
                                </div>
                            </div>

                            <!-- ACADEMIC INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">ACADEMIC INFORMATION</h6>
                                </div>
                                <div class="card-body row">
                                    <div class="col-6">
                                        <label class="form-label">Course / Program</label>
                                        <select class="form-select" name="course_id">
                                            <option value="">Select</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ old('course_id', $student->course_id) == $course->id ? 'selected' : '' }}>
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Batch / Class</label>
                                        <select class="form-select" name="batch_id">
                                            <option value="">Select</option>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    {{ old('batch_id', $student->batch_id) == $batch->id ? 'selected' : '' }}>
                                                    {{ $batch->batch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Enroll Date</label>
                                        <input type="date" name="enroll_date" class="form-control"
                                            value="{{ $student->enroll_date }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status">
                                            <option selected>Select</option>
                                            <option {{ old('status', $student->status) == 'active' ? 'selected' : '' }}
                                                value="active">Active</option>
                                            <option {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}
                                                value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- PARENT/GUARDIAN INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">PARENTS / GUARDIAN INFORMATION</h6>
                                </div>
                                <div class="card-body row">
                                    <div class="col-6">
                                        <label class="form-label">Parent/Guardian Name</label>
                                        <input type="text" name="parent_guardian_name" class="form-control"
                                            value="{{ $student->parent_guardian_name }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Relationship</label>
                                        <select class="form-select" name="relationship">
                                            <option selected>Select</option>
                                            <option
                                                {{ old('relationship', $student->relationship) == 'father' ? 'selected' : '' }}
                                                value="Father">Father</option>
                                            <option
                                                {{ old('relationship', $student->relationship) == 'mother' ? 'selected' : '' }}
                                                value="Mother">Mother</option>
                                            <option
                                                {{ old('relationship', $student->relationship) == 'guardian' ? 'selected' : '' }}
                                                value="Guardian">Guardian</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Parent Phone</label>
                                        <input type="number" name="parent_phone" class="form-control"
                                            value="{{ $student->parent_phone }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Parent Email</label>
                                        <input type="email" name="parent_email" class="form-control"
                                            value="{{ $student->parent_email }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Parent Address</label>
                                        <input type="text" name="parent_address" class="form-control"
                                            value="{{ $student->parent_address }}">
                                    </div>
                                </div>
                            </div>

                            <!-- SYSTEM ACCOUNT INFORMATION -->
                            <div class="card shadow-none border mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0">SYSTEM ACCOUNT INFORMATION</h6>
                                </div>
                                <div class="card-body row">
                                    <div class="col-6">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ $student->username }}" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Login Email</label>
                                        <input type="email" name="login_email" class="form-control"
                                            value="{{ $student->login_email }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="profile_image" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="text-start">
                                <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                            </div>
                        </form>
                        <!-- SINGLE FORM END -->

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
