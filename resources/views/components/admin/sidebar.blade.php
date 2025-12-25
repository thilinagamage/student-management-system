        <!--start sidebar -->
        <aside class="sidebar-wrapper semi-dark" data-simplebar="true">
          <div class="sidebar-header">
            <div>
              <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
              <h4 class="logo-text">Onedash</h4>
            </div>
            <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">

              <a href="{{ route('admin.dashboard') }}" class="">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a>

            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Students</div>
              </a>
              <ul>
                <li> <a href=""><i class="bi bi-circle"></i>Manage Students </a>
                </li>
                <li> <a href="app-chat-box.html"><i class="bi bi-circle"></i>Student Attendance</a>
                </li>
                <li> <a href="app-file-manager.html"><i class="bi bi-circle"></i>Student Results </a>
                </li>
                <li> <a href="app-to-do.html"><i class="bi bi-circle"></i>Enroll Student to Batch</a>
                </li>
                <li> <a href="app-invoice.html"><i class="bi bi-circle"></i>Student Documents</a>
                </li>
                <li> <a href="app-fullcalender.html"><i class="bi bi-circle"></i>Graduation / Alumni</a>
                </li>
              </ul>
            </li>
            {{-- <li class="menu-label">UI Elements</li> --}}
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-droplet-fill"></i>
                </div>
                <div class="menu-title">Teachers</div>
              </a>
              <ul>
                <li> <a href="widgets-static-widgets.html"><i class="bi bi-circle"></i>Manage Teachers</a>
                </li>
                <li> <a href="widgets-data-widgets.html"><i class="bi bi-circle"></i>Assign Subjects / Batches</a>
                </li>
                <li> <a href="widgets-data-widgets.html"><i class="bi bi-circle"></i>Teacher Attendance</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-basket2-fill"></i>
                </div>
                <div class="menu-title">Courses / Programs</div>
              </a>
              <ul>
                <li> <a href="ecommerce-products-list.html"><i class="bi bi-circle"></i>Manage Courses</a>
                </li>
                <li> <a href="ecommerce-products-grid.html"><i class="bi bi-circle"></i>Manage Batches</a>
                </li>
                <li> <a href="ecommerce-products-categories.html"><i class="bi bi-circle"></i>Manage Subjects</a>
                </li>
                <li> <a href="ecommerce-orders.html"><i class="bi bi-circle"></i>Assign Teachers</a>
                </li>

              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-award-fill"></i>
                </div>
                <div class="menu-title">Attendance</div>
              </a>
              <ul>
                <li> <a href="component-alerts.html"><i class="bi bi-circle"></i>Mark Attendance</a>
                </li>
                <li> <a href="component-accordions.html"><i class="bi bi-circle"></i>Attendance Reports</a>
                </li>
                <li> <a href="component-badges.html"><i class="bi bi-circle"></i>Attendance Calendar</a>
                </li>
                            </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
                </div>
                <div class="menu-title">Exams & Results</div>
              </a>
              <ul>
                <li> <a href="icons-line-icons.html"><i class="bi bi-circle"></i>Manage Exams</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-circle"></i>Enter Marks</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-circle"></i>Generate Report Cards</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-circle"></i>Result Analytics</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-file-earmark-spreadsheet-fill"></i>
                </div>
                <div class="menu-title">Fees & Payments</div>
              </a>
              <ul>
                <li> <a href="table-basic-table.html"><i class="bi bi-circle"></i>Fee Structure</a>
                </li>
                <li> <a href="table-advance-tables.html"><i class="bi bi-circle"></i>Generate Invoices</a>
                </li>
                <li> <a href="table-datatable.html"><i class="bi bi-circle"></i>Record Payments</a>
                </li>
                <li> <a href="table-datatable.html"><i class="bi bi-circle"></i>Fee Reports (Collected / Pending)</a>
                </li>
              </ul>
            </li>


            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-lock-fill"></i>
                </div>
                <div class="menu-title">Timetable</div>
              </a>
              <ul>
                <li> <a href="authentication-signin.html" target="_blank"><i class="bi bi-circle"></i>Create / Update Timetable</a>
                </li>
                <li> <a href="authentication-signup.html" target="_blank"><i class="bi bi-circle"></i>View Batch Timetable</a>
                </li>
                <li> <a href="authentication-signin-with-header-footer.html" target="_blank"><i class="bi bi-circle"></i>Teacher Timetable</a>
                </li>
              </ul>
            </li>

            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="menu-title">Learning Materials</div>
              </a>
              <ul>
                <li> <a href="pages-errors-404-error.html" target="_blank"><i class="bi bi-circle"></i>Upload Materials</a>
                </li>
                <li> <a href="pages-errors-500-error.html" target="_blank"><i class="bi bi-circle"></i>Assign Materials to Course/Batch</a>
                </li>
                <li> <a href="pages-errors-coming-soon.html" target="_blank"><i class="bi bi-circle"></i>Download History</a>
                </li>
                <li> <a href="pages-blank-page.html" target="_blank"><i class="bi bi-circle"></i>Blank Page</a>
                </li>
              </ul>
            </li>

           <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-bar-chart-line-fill"></i>
                </div>
                <div class="menu-title">Communication</div>
              </a>
              <ul>
                <li> <a href="charts-apex-chart.html"><i class="bi bi-circle"></i>Announcements</a>
                </li>
                <li> <a href="charts-chartjs.html"><i class="bi bi-circle"></i>Notifications</a>
                </li>
                <li> <a href="charts-highcharts.html"><i class="bi bi-circle"></i>Email / SMS</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-pin-map-fill"></i>
                </div>
                <div class="menu-title">Certificates / ID Cards</div>
              </a>
              <ul>
                <li> <a href="map-google-maps.html"><i class="bi bi-circle"></i>Generate Student ID Cards</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Course Completion Certificates</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Download PDFs</a>
                </li>
              </ul>
            </li>

            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-music-note-list"></i>
                </div>
                <div class="menu-title">Settings</div>
              </a>
              <ul>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Institute Details</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Academic Year</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Role & Permissions</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Email / SMS Gateway</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Attendance Settings</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Fee Settings</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-music-note-list"></i>
                </div>
                <div class="menu-title">Reports / Analytics</div>
              </a>
              <ul>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Student Reports</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Attendance Reports</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Exam Results Analytics</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Fee Collection Reports</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Teacher Workload</a>
                </li>
              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-music-note-list"></i>
                </div>
                <div class="menu-title">Logout</div>
              </a>
              <ul>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>User Profile</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Change Password</a>
                </li>
                <li> <a href="map-vector-maps.html"><i class="bi bi-circle"></i>Logout</a>
                </li>
              </ul>
            </li>


          </ul>
          <!--end navigation-->
       </aside>
       <!--end sidebar -->
