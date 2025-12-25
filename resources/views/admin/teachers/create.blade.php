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
          <h5 class="mb-0">Add Teacher</h5>
          <hr>

          <form class="row g-3" action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- PERSONAL INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header">
                <h6 class="mb-0">PERSONAL INFORMATION</h6>
              </div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="first_name" required>
                </div>

                <div class="col-6">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" name="last_name" required>
                </div>

                <div class="col-6">
                  <label class="form-label">Gender</label>
                  <select class="form-select" name="gender">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>

                <div class="col-6">
                  <label class="form-label">NIC Number</label>
                  <input type="text" class="form-control" name="nic_number">
                </div>
                <div class="col-6">
                  <label class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" name="dob">
`                </div>
                <div class="col-6">
                  <label class="form-label">Joined Date</label>
                  <input type="date" class="form-control" name="joined_date">
                </div>

                <div class="col-6">
                  <label class="form-label">Status</label>
                  <select class="form-select" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
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
                  <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-6">
                  <label class="form-label">WhatsApp Number</label>
                  <input type="text" name="whatsapp_number" class="form-control">
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

            <!-- SYSTEM ACCOUNT INFORMATION -->
            <div class="card shadow-none border mb-3">
              <div class="card-header">
                <h6 class="mb-0">SYSTEM ACCOUNT INFORMATION</h6>
              </div>
              <div class="card-body row">
                <div class="col-6">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" required>
                </div>

                <div class="col-6">
                  <label class="form-label">Login Email</label>
                  <input type="email" name="login_email" class="form-control" required>
                </div>

                <div class="col-6">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-6">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="col-12">
                  <label class="form-label">Profile Image</label>
                  <input type="file" name="profile_image" class="form-control">
                </div>
              </div>
            </div>

            <div class="text-start">
              <button type="submit" class="btn btn-primary px-4">Save Teacher</button>
            </div>

          </form>
      </div>
    </div>
  </div>
</div>


</main>

@endsection
