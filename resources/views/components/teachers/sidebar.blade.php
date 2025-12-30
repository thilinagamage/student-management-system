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
                <li>
                    <a href="{{ route('teacher.subjects') }}">
                        <i class="bi bi-circle"></i>My Subjects
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
                    <a href="{{ route('teacher.attendance.create') }}">
                        <i class="bi bi-circle"></i>Mark Attendance
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.attendance.index') }}">
                        <i class="bi bi-circle"></i>View Attendance
                    </a>
                </li>
            </ul>
        </li>

        <!-- Results / Marks -->
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-bar-chart-fill"></i></div>
                <div class="menu-title">Results</div>
            </a>
            <ul>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>Add Results
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="bi bi-circle"></i>View Results
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
