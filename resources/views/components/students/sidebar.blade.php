@auth
@if(auth()->user()->user_type === 'student')

<aside class="sidebar-wrapper semi-dark" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/brand-logo-3.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Wisdom Academy</h4>
        </div>
    </div>

    <ul class="metismenu" id="menu">

        {{-- Dashboard --}}
        <li>
            <a href="">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        {{-- My Profile --}}
        <li>
            <a href="{{ route('profile') }}">
                <div class="parent-icon"><i class="bi bi-person-fill"></i></div>
                <div class="menu-title">My Profile</div>
            </a>
        </li>

        {{-- My Enrollment --}}
        <li>
            <a href="">
                <div class="parent-icon"><i class="bi bi-journal-check"></i></div>
                <div class="menu-title">My Enrollment</div>
            </a>
        </li>

        {{-- Attendance --}}
        <li>
            <a href="">
                <div class="parent-icon"><i class="bi bi-award-fill"></i></div>
                <div class="menu-title">My Attendance</div>
            </a>
        </li>

        {{-- Results (Optional) --}}
        <li>
            <a href="">
                <div class="parent-icon"><i class="bi bi-bar-chart-fill"></i></div>
                <div class="menu-title">My Results</div>
            </a>
        </li>

        {{-- Logout --}}
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="parent-icon"><i class="bi bi-box-arrow-right"></i></div>
                <div class="menu-title">Logout</div>
            </a>
        </li>

    </ul>
</aside>

@endif
@endauth
