<!--start sidebar -->
<aside class="sidebar-wrapper semi-dark" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/brand-logo-3.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Wisdom Academy</h4>
        </div>
        <div class="toggle-icon ms-auto">
            <i class="bi bi-list"></i>
        </div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('teacher.dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <!-- My Classes -->
        <li>
            <a class="has-arrow" href="#">
                <div class="parent-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                <div class="menu-title">My Classes</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('teacher.batches') }}">
                        <i class="bi bi-circle"></i>My Batches
                    </a>
                </li>

            </ul>
        </li>

        <!-- Students -->
        <li>
            <a href="">
                <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                <div class="menu-title">Students</div>
            </a>
        </li>

        <!-- Attendance -->
        <li>
            <a class="has-arrow" href="#">
                <div class="parent-icon"><i class="bi bi-award-fill"></i></div>
                <div class="menu-title">Attendance</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('teacher.teacher-attendance.index') }}">
                        <i class="bi bi-circle"></i>My Attendance
                    </a>
                <li>
                    <a href="{{ route('teacher.student-attendance.create') }}">
                        <i class="bi bi-circle"></i>Mark Student Attendance
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.student-attendance.index') }}">
                        <i class="bi bi-circle"></i>View Student Attendance
                    </a>
                </li>
            </ul>
        </li>
        <!-- Profile -->
        <li>
            <a href="{{ route('profile') }}">
                <div class="parent-icon"><i class="bi bi-person-circle"></i></div>
                <div class="menu-title">My Profile</div>
            </a>
        </li>

    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
