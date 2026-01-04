 <!--start wrapper-->

    <!--start top header-->
      <header class="top-header">
        <nav class="navbar navbar-expand gap-3">
          <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
              <i class="bi bi-list"></i>
            </div>
            <form action="{{ route('admin.search') }}" method="GET" class="d-flex ms-auto">
                <input
                    type="text"
                    name="q"
                    class="form-control form-control-sm me-2"
                    placeholder="Search..."
                    value="{{ request('q') }}"
                    required
                >

                <button class="btn btn-sm btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>


            <div class="top-navbar-right ms-auto">
              <ul class="navbar-nav align-items-center gap-1">
                <li class="nav-item search-toggle-icon d-flex d-lg-none">
                  <a class="nav-link" href="javascript:;">
                    <div class="">
                      <i class="bi bi-search"></i>
                    </div>
                  </a>
               </li>

              </ul>
              </div>
              <div class="dropdown dropdown-user-setting">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center gap-3">
                       @php
                            $user = auth()->user();
                        @endphp
                        @php
                            $user = auth()->user();
                            $profileImage = 'default-avatar.png'; // fallback image

                            if ($user) {
                                if ($user->user_type === 'student' && $user->student) {
                                    $profileImage = $user->student->profile_image;
                                } elseif ($user->user_type === 'teacher' && $user->teacher) {
                                    $profileImage = $user->teacher->profile_image;
                                }
                            }
                        @endphp

                        <img
                            src="{{ asset('storage/' . $profileImage) }}"
                            class="user-img"
                            alt="User"
                        />


                      <div class="d-none d-sm-block">
                        @if($user)
                            <p class="user-name mb-0">{{ $user->username ?? 'User' }}</p>
                        @else
                            <p class="user-name mb-0">Guest</p>
                        @endif


                    </div>

                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                   <li>
                      <a class="dropdown-item" href="{{ route('profile') }}">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item text-danger" type="submit">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
                    </li>
                </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

</body>
</html>
