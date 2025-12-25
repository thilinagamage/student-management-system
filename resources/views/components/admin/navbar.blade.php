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

            <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
                <input class="form-control" type="text" placeholder="Type here to search">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
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
                        <img
                            src="{{ $user && $user->profile_image
                                ? asset('storage/'.$user->profile_image)
                                : asset('assets/images/default-user.png') }}"
                            class="user-img"
                            alt="User"
                        />
                      <div class="d-none d-sm-block">
                        @if($user)
                            <p class="user-name mb-0">{{ $user->username ?? 'User' }}</p>
                        @else
                            <p class="user-name mb-0">Guest</p>
                        @endif

                      <small class="mb-0 dropdown-user-designation">HR Manager</small>
                    </div>

                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                   <li>
                      <a class="dropdown-item" href="pages-user-profile.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-gear-fill"></i></div>
                           <div class="ms-3"><span>Setting</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="index2.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-speedometer"></i></div>
                           <div class="ms-3"><span>Dashboard</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-piggy-bank-fill"></i></div>
                           <div class="ms-3"><span>Earnings</span></div>
                         </div>
                       </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-cloud-arrow-down-fill"></i></div>
                           <div class="ms-3"><span>Downloads</span></div>
                         </div>
                       </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <a class="dropdown-item" href="authentication-signup-with-header-footer.html">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-lock-fill"></i></div>
                           <div class="ms-3"><span>Logout</span></div>
                         </div>
                       </a>
                    </li>
                </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->

</body>
</html>
