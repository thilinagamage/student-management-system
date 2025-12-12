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
          <h5 class="mb-0">Add Student</h5>
          <hr>

          <!-- SINGLE FORM START -->
          <form class="row g-3" action="{{ route('admin.storestudent') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- USER INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header"><h6 class="mb-0">USER INFORMATION</h6></div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="first_name">
                </div>
                <div class="col-6">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" name="last_name">
                </div>
                <div class="col-6">
                  <label class="form-label">Gender</label>
                  <select class="form-select" name="gender">
                    <option selected>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Date of Birth</label>
                  <input type="date" name="dob" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Age</label>
                  <input type="number" name="age" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">NIC Number</label>
                  <input type="text" name="nic_number" class="form-control">
                </div>
              </div>
            </div>

            <!-- CONTACT INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header"><h6 class="mb-0">CONTACT INFORMATION</h6></div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">Phone Number</label>
                  <input type="number" name="phone_number" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">WhatsApp Number</label>
                  <input type="number" name="whatsapp_number" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Address</label>
                  <input type="text" name="address" class="form-control">
                </div>
              </div>
            </div>

            <!-- ACADEMIC INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header"><h6 class="mb-0">ACADEMIC INFORMATION</h6></div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">Course / Program</label>
                  <select class="form-select" name="course">
                    <option selected>Select</option>
                    <option value="CS">CS</option>
                    <option value="Design">Design</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Batch / Class</label>
                  <select class="form-select" name="batch">
                    <option selected>Select</option>
                    <option value="cs">CS</option>
                    <option value="design">Design</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Enroll Date</label>
                  <input type="date" name="enroll_date" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Status</label>
                  <select class="form-select" name="status">
                    <option selected>Select</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- PARENT/GUARDIAN INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header"><h6 class="mb-0">PARENTS / GUARDIAN INFORMATION</h6></div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">Parent/Guardian Name</label>
                  <input type="text" name="parent_guardian_name" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Relationship</label>
                  <select class="form-select" name="relationship">
                    <option selected>Select</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Guardian">Guardian</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Parent Phone</label>
                  <input type="number" name="parent_phone" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Parent Email</label>
                  <input type="email" name="parent_email" class="form-control">
                </div>
                <div class="col-12">
                  <label class="form-label">Parent Address</label>
                  <input type="text" name="parent_address" class="form-control">
                </div>
              </div>
            </div>

            <!-- SYSTEM ACCOUNT INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header"><h6 class="mb-0">SYSTEM ACCOUNT INFORMATION</h6></div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">Login Email</label>
                  <input type="email" name="login_email" class="form-control">
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
