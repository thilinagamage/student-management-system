<aside class="sidebar-wrapper semi-dark" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/brand-logo-3.png') }}" class="logo-icon" alt="logo">
        </div>
        <div>
            <h4 class="logo-text">Wisdom Academy</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bi bi-list"></i>
        </div>
    </div>

    <ul class="metismenu" id="menu">

        {{-- DASHBOARD --}}
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        {{-- SUPER ADMIN ONLY --}}
        @if(auth()->user()->isSuperAdmin())
        <li class="menu-label">System Management</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-shield-lock-fill"></i></div>
                <div class="menu-title">Admin Management</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.admins.create') }}"><i class="bi bi-circle"></i>Add Admin</a></li>
                <li><a href="{{ route('admin.admins.index') }}"><i class="bi bi-circle"></i>View Admins</a></li>
            </ul>
        </li>
        @endif

        {{-- STUDENT MANAGEMENT --}}
        <li class="menu-label">Academic Management</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                <div class="menu-title">Students</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.students.create') }}"><i class="bi bi-circle"></i>Add Student</a></li>
                <li><a href="{{ route('admin.students.index') }}"><i class="bi bi-circle"></i>Manage Students</a></li>

                <li class="has-arrow">
                    <a href="javascript:;"><i class="bi bi-circle"></i>Enrollments</a>
                    <ul>
                        <li><a href="{{ route('admin.student-enrollment.create') }}">Create Enrollment</a></li>
                        <li><a href="{{ route('admin.student-enrollment.index') }}">View Enrollments</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        {{-- TEACHERS --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-person-badge-fill"></i></div>
                <div class="menu-title">Teachers</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.teachers.create') }}"><i class="bi bi-circle"></i>Add Teacher</a></li>
                <li><a href="{{ route('admin.teachers.index') }}"><i class="bi bi-circle"></i>Manage Teachers</a></li>
                <li><a href="{{ route('admin.teacher-assignments.index') }}"><i class="bi bi-circle"></i>Assignments</a></li>
            </ul>
        </li>

        {{-- COURSES --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-book-fill"></i></div>
                <div class="menu-title">Courses & Programs</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.courses.index') }}"><i class="bi bi-circle"></i>Courses</a></li>
                <li><a href="{{ route('admin.course-types.index') }}"><i class="bi bi-circle"></i>Course Types</a></li>

                <li class="has-arrow">
                    <a href="javascript:;"><i class="bi bi-circle"></i>Batches</a>
                    <ul>
                        <li><a href="{{ route('admin.batches.index') }}">Manage Batches</a></li>
                        <li><a href="{{ route('admin.batches.create') }}">Add Batch</a></li>
                    </ul>
                </li>

                <li class="has-arrow">
                    <a href="javascript:;"><i class="bi bi-circle"></i>Subjects</a>
                    <ul>
                        <li><a href="{{ route('admin.subjects.index') }}">Manage Subjects</a></li>
                        <li><a href="{{ route('admin.subjects.create') }}">Add Subject</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        {{-- ATTENDANCE --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-calendar-check-fill"></i></div>
                <div class="menu-title">Attendance</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.teacher-attendance.index') }}"><i class="bi bi-circle"></i>Teacher Attendance</a>
                </li>
                <li>
                    <a href="{{ route('admin.student-attendance.index') }}"><i class="bi bi-circle"></i>Student Attendance</a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
