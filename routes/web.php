<?php

use App\Http\Controllers\Admin\Academic\StudentEnrollmentController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Attendance\StudentAttendanceController;
use App\Http\Controllers\Admin\Course\BatchController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Course\CourseTypeController;
use App\Http\Controllers\Admin\Course\SubjectController;
use App\Http\Controllers\Admin\Course\TeacherAssignmentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use App\Http\Controllers\Admin\Attendance\TeacherAttendanceController;
use App\Http\Controllers\Teacher\TeacherAttendanceController as TeacherAttendance;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
// Route::get('/', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
// Route::post('/login', [LoginController::class, 'login'])->name('auth.login.submit');
// Route::post('/logout', [LoginController::class, 'logoutAndRedirect'])->name('logout');


// /*
// |--------------------------------------------------------------------------
// | ADMIN ROUTES (ONLY ADMIN)
// |--------------------------------------------------------------------------
// */
// Route::middleware(['role:admin'])->group(function () {

//     // Admin Dashboard
//     Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])
//         ->name('admin.dashboard');

//     // Admin Management
//     Route::prefix('admin')->group(function () {
//         Route::get('/', [AdminController::class, 'index'])->name('admin.admins.index');
//         Route::get('/create', [AdminController::class, 'create'])->name('admin.admins.create');
//         Route::post('/store', [AdminController::class, 'store'])->name('admin.admins.store');
//         Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('admin.admins.edit');
//         Route::post('/update/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
//         Route::delete('/delete/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.delete');
//     });

//     // Teachers
//     Route::prefix('admin/teachers')->group(function () {
//         Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
//         Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
//         Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
//         Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
//         Route::post('/update/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
//         Route::get('/view/{id}', [TeacherController::class, 'view'])->name('admin.teachers.view');
//         Route::get('/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teachers.delete');
//     });


//     // Students
//     Route::prefix('admin/students')->group(function () {
//         Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
//         Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
//         Route::post('/store', [StudentController::class, 'store'])->name('admin.students.store');
//         Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
//         Route::post('/update/{id}', [StudentController::class, 'update'])->name('admin.students.update');
//         Route::get('/view/{id}', [StudentController::class, 'view'])->name('admin.students.view');
//         Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('admin.students.delete');
//     });

//     // Courses / Types / Subjects / Batches
//     Route::resource('courses', CourseController::class)->names('admin.courses');
//     Route::resource('course-types', CourseTypeController::class)->names('admin.course-types');
//     Route::resource('subjects', SubjectController::class)->names('admin.subjects');
//     Route::resource('batches', BatchController::class)->names('admin.batches');


//     // Attendance
//     Route::resource('student-attendance', StudentAttendanceController::class)->names('admin.student-attendance');
//     Route::resource('teacher-attendance', TeacherAttendanceController::class)->names('admin.teacher-attendance');

//     // Teacher Assignments
//     Route::resource('teacher-assignments', TeacherAssignmentController::class)->names('admin.teacher-assignments');
//     Route::get('teacher-assignments/{id}/assign-subjects',[TeacherAssignmentController::class, 'assignSubjects'])->name('admin.teacher-assignments.assign-subjects');
//     Route::post('teacher-assignments/{id}/assign-subjects',[TeacherAssignmentController::class, 'storeAssignedSubjects'])->name('admin.teacher-assignments.assign-subjects.store');
//     Route::get('teacher-assignments/{id}/assign-batches',[TeacherAssignmentController::class, 'assignBatches'])->name('admin.teacher-assignments.assign-batches');
//     Route::post('teacher-assignments/{id}/assign-batches',[TeacherAssignmentController::class, 'storeAssignedBatches'])->name('admin.teacher-assignments.assign-batches.store');


//     //Reports
//     Route::get('student-attendance-report',[StudentAttendanceController::class, 'report'])->name('admin.student-attendance.report');
//     Route::get('teacher-attendance-report',[TeacherAttendanceController::class, 'report'])->name('admin.teacher-attendance.report');

//     //Exports
//     Route::get('/teacher-attendance/export-excel',[TeacherAttendanceController::class, 'exportExcel'])->name('admin.teacher-attendance.export.excel');
//     Route::get('teacher-attendance-export-pdf',[TeacherAttendanceController::class, 'exportPdf'])->name('admin.teacher-attendance.export.pdf');
//     Route::get('student-attendance/batch-report/excel',[StudentAttendanceController::class, 'exportBatchExcel'])->name('admin.student-attendance.batch-report.excel');
//     Route::get('student-attendance/batch-report/pdf',[StudentAttendanceController::class, 'exportBatchPdf'])->name('admin.student-attendance.batch-report.pdf');
//     Route::get('student-attendance/batch-report/excel',[StudentAttendanceController::class, 'exportBatchExcel'])->name('admin.student-attendance.batch-report.excel');
//     Route::get('student-attendance/batch-report/pdf',[StudentAttendanceController::class, 'exportBatchPdf'])->name('admin.student-attendance.batch-report.pdf');



// });


// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
//     Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
// });


// /*
// |--------------------------------------------------------------------------
// | ADMIN & RECEPTIONIST ROUTES
// |--------------------------------------------------------------------------
// */

// Route::middleware(['role:admin,receptionist'])->group(function () {

//     // Students
//     Route::prefix('student')->group(function () {
//         Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
//         Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
//         Route::post('/save', [StudentController::class, 'store'])->name('admin.students.store');
//         Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
//         Route::post('/update/{id}', [StudentController::class, 'update'])->name('admin.students.update');
//         Route::get('/view/{id}', [StudentController::class, 'show'])->name('admin.students.view');
//         Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('admin.students.delete');
//     });

//     // Student Enrollment
//     Route::prefix('student-enrollment')->group(function () {
//         Route::get('/', [StudentEnrollmentController::class, 'index'])->name('admin.student-enrollment.index');
//         Route::get('/create', [StudentEnrollmentController::class, 'create'])->name('admin.student-enrollment.create');
//         Route::post('/store', [StudentEnrollmentController::class, 'store'])->name('admin.student-enrollment.store');
//         Route::get('/edit/{studentId}', [StudentEnrollmentController::class, 'edit'])->name('admin.student-enrollment.edit');
//         Route::post('/update/{studentId}', [StudentEnrollmentController::class, 'update'])->name('admin.student-enrollment.update');
//         Route::get('/delete/{student}', [StudentEnrollmentController::class, 'destroy'])->name('admin.student-enrollment.delete');
//     });

// });

// /*
// |--------------------------------------------------------------------------
// | TEACHER ROUTES (ONLY TEACHER)
// |--------------------------------------------------------------------------
// */

// Route::middleware(['role:teacher'])->prefix('teacher')->group(function () {
//     Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
// });


// /*
// |--------------------------------------------------------------------------
// | STUDENT ROUTES (ONLY STUDENT)
// |--------------------------------------------------------------------------
// */

// Route::middleware(['role:student'])->prefix('student')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'studentDashboard'])->name('student.dashboard');
// });


// /*
// |--------------------------------------------------------------------------
// | ADMIN, TEACHER & RECEPTIONIST SEARCH ROUTE
// |--------------------------------------------------------------------------
// */
// Route::middleware(['role:admin,teacher,receptionist'])
//     ->get('/search', [SearchController::class, 'index'])
//     ->name('admin.search');





// Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

//     Route::get('/dashboard', [AdminController::class, 'adminDashboard'])
//         ->name('admin.dashboard');

//     // Admin Management
//     Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
//     Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
//     Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');
//     Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->name('admin.admins.edit');
//     Route::post('/admins/update/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
//     Route::delete('/admins/delete/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.delete');

// });



// Route::prefix('student')->group(function(){
//     Route::get('/dashboard', [AdminController::class, 'studentDashboard'])-> name('student.dashboard');
//     Route::get('/', [StudentController::class, 'index'])-> name('admin.students.index');
//     Route::get('/create', [StudentController::class, 'create'])-> name('admin.students.create');
//     Route::post('/save', [StudentController::class, 'store'])-> name('admin.students.store');
//     Route::get('/delete/{id}', [StudentController::class, 'delete'])-> name('admin.students.delete');
//     Route::get('/edit/{id}', [StudentController::class, 'edit'])-> name('admin.students.edit');
//     Route::post('/update/{id}/update', [StudentController::class, 'update'])-> name('admin.students.update');
//     Route::get('/view/{id}', [StudentController::class, 'show'])-> name('admin.students.view');

// });

// Route::prefix('admin/teachers')->group(function () {
//     Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
//     Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
//     Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
//     Route::get('/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teachers.delete');
//     Route::get('/view/{id}', [TeacherController::class, 'view'])->name('admin.teachers.view');
//     Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
//     Route::post('/update/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
// });

// Route::prefix('courses')->group(function(){
//     Route::get('/', [CourseController::class, 'index'])-> name('admin.courses.index');
//     Route::get('/create', [CourseController::class, 'create'])-> name('admin.courses.create');
//     Route::post('/store', [CourseController::class, 'store'])-> name('admin.courses.store');
//     Route::get('/edit/{id}', [CourseController::class, 'edit'])-> name('admin.courses.edit');
//     Route::post('/update/{id}', [CourseController::class, 'update'])-> name('admin.courses.update');
//     Route::get('/delete/{id}', [CourseController::class, 'delete'])-> name('admin.courses.delete');
//     Route::get('/view/{id}', [CourseController::class, 'view'])-> name('admin.courses.view');
// });

// Route::prefix('course-types')->group(function(){
//     Route::get('/', [CourseTypeController::class, 'index'])-> name('admin.course-types.index');
//     Route::get('/create', [CourseTypeController::class, 'create'])-> name('admin.course-types.create');
//     Route::post('/store', [CourseTypeController::class, 'store'])-> name('admin.course-types.store');
//     Route::get('/edit/{courseType}', [CourseTypeController::class, 'edit'])-> name('admin.course-types.edit');
//     Route::post('/update/{courseType}', [CourseTypeController::class, 'update'])-> name('admin.course-types.update');
//     Route::get('/delete/{courseType}', [CourseTypeController::class, 'delete'])-> name('admin.course-types.delete');
//     Route::get('/view/{courseType}', [CourseTypeController::class, 'view'])-> name('admin.course-types.view');
// });

// Route::prefix('batches')->group(function(){
//     Route::get('/', [BatchController::class, 'index'])-> name('admin.batches.index');
//     Route::get('/create', [BatchController::class, 'create'])-> name('admin.batches.create');
//     Route::post('/store', [BatchController::class, 'store'])-> name('admin.batches.store');
//     Route::get('/view/{id}', [BatchController::class, 'show'])-> name('admin.batches.view');
//     Route::get('/edit/{id}', [BatchController::class, 'edit'])-> name('admin.batches.edit');
//     Route::post('/update/{id}', [BatchController::class, 'update'])-> name('admin.batches.update');
//     Route::get('/delete/{id}', [BatchController::class, 'delete'])-> name('admin.batches.delete');

//     // Route::get('batches/{id}/assign-subjects',[BatchController::class, 'assignSubjects'])->name('admin.batches.assign-subjects');
//     // Route::post('batches/{id}/assign-subjects',[BatchController::class, 'storeAssignedSubjects'])->name('admin.batches.assign-subjects.store');

//     // Route::get('batches/{id}/assign-teachers',[BatchController::class, 'assignTeachers'])->name('admin.batches.assign-teachers');
//     // Route::post('batches/{id}/assign-teachers',[BatchController::class, 'storeAssignedTeachers'])->name('admin.batches.assign-teachers.store');
//     // Route::get('batches/{batch}/subjects',[BatchController::class, 'subjectsByBatch'])->name('batches.subjects');


// });

// Route::prefix('teacher-assignments')->group(function () {
//     Route::get('/',[TeacherAssignmentController::class, 'index'])->name('admin.teacher-assignments.index');
//     Route::get('/create',[TeacherAssignmentController::class, 'create'])->name('admin.teacher-assignments.create');
//     Route::post('/',[TeacherAssignmentController::class, 'store'])->name('admin.teacher-assignments.store');
//     Route::get('/{assignment}/edit',[TeacherAssignmentController::class, 'edit'])->name('admin.teacher-assignments.edit');
//     Route::post('/{assignment}',[TeacherAssignmentController::class, 'update'])->name('admin.teacher-assignments.update');
//     Route::get('delete/{assignment}',[TeacherAssignmentController::class, 'delete'])->name('admin.teacher-assignments.delete');
// });

// Route::prefix('subjects')->group(function(){
//     Route::get('/', [SubjectController::class, 'index'])-> name('admin.subjects.index');
//     Route::get('/create', [SubjectController::class, 'create'])-> name('admin.subjects.create');
//     Route::post('/store', [SubjectController::class, 'store'])-> name('admin.subjects.store');
//     Route::get('/view/{id}', [SubjectController::class, 'show'])-> name('admin.subjects.view');
//     Route::get('/edit/{id}', [SubjectController::class, 'edit'])-> name('admin.subjects.edit');
//     Route::post('/update/{id}', [SubjectController::class, 'update'])-> name('admin.subjects.update');
//     Route::get('/delete/{id}', [SubjectController::class, 'delete'])-> name('admin.subjects.delete');

// });

// Route::prefix('student-enrollment')->group(function(){
//     Route::get('/', [StudentEnrollmentController::class, 'index'])->name('admin.student-enrollment.index');
//     Route::get('/create', [StudentEnrollmentController::class, 'create'])->name('admin.student-enrollment.create');
//     Route::post('/store', [StudentEnrollmentController::class, 'store'])->name('admin.student-enrollment.store');
//     Route::get('/delete/{student}',[StudentEnrollmentController::class, 'destroy'])->name('admin.student-enrollment.delete');
//     Route::get('/edit/{studentId}', [StudentEnrollmentController::class, 'edit'])->name('admin.student-enrollment.edit');
//     Route::post('/update/{studentId}', [StudentEnrollmentController::class, 'update'])->name('admin.student-enrollment.update');

// });

// Route::prefix('student-attendance')->group(function(){
//     Route::get('/create', [StudentAttendanceController::class, 'create'])->name('admin.student-attendance.create');
//     Route::post('/store', [StudentAttendanceController::class, 'store'])->name('admin.student-attendance.store');
//     Route::get('/', [StudentAttendanceController::class, 'index'])->name('admin.student-attendance.index');
//     Route::get('student-attendance/{batch}/{date}/edit',[StudentAttendanceController::class, 'edit'])->name('admin.student-attendance.edit');
//     Route::put('student-attendance/{batch}/{date}',[StudentAttendanceController::class, 'update'])->name('admin.student-attendance.update');
//     Route::get('delete/{batch}/{date}', [StudentAttendanceController::class, 'destroy'])->name('admin.student-attendance.delete');
//     Route::get('student-attendance/{attendance}',[StudentAttendanceController::class, 'destroySingle'])->name('admin.student-attendance.destroy.single');
//     Route::get('student-attendance-report',[StudentAttendanceController::class, 'report'])->name('admin.student-attendance.report');
//     Route::get('/batch-report',[StudentAttendanceController::class, 'batchReport'])->name('admin.student-attendance.batch-report');




// });

// Route::prefix('teacher-attendance')->group(function(){
//     Route::get('/', [TeacherAttendanceController::class, 'index'])-> name('admin.teacher-attendance.index');
//     Route::get('/create', [TeacherAttendanceController::class, 'create'])-> name('admin.teacher-attendance.create');
//     Route::post('/store', [TeacherAttendanceController::class, 'store'])-> name('admin.teacher-attendance.store');
//     Route::get('/edit/{id}',[TeacherAttendanceController::class, 'edit'])->name('admin.teacher-attendance.edit');
//     Route::put('teacher-attendance/{batch}/{date}',[TeacherAttendanceController::class, 'update'])->name('admin.teacher-attendance.update');
//     Route::delete('/delete/{teacherAttendance}', [TeacherAttendanceController::class, 'destroy'])-> name('admin.teacher-attendance.delete');
//     Route::get('teacher-attendance-report',[TeacherAttendanceController::class, 'report'])->name('admin.teacher-attendance.report');
//     Route::get('/teacher-attendance/export-excel',[TeacherAttendanceController::class, 'exportExcel'])->name('admin.teacher-attendance.export.excel');
//     Route::get('teacher-attendance-export-pdf',[TeacherAttendanceController::class, 'exportPdf'])->name('admin.teacher-attendance.export.pdf');
//     Route::get('student-attendance/batch-report/excel',[StudentAttendanceController::class, 'exportBatchExcel'])->name('admin.student-attendance.batch-report.excel');
//     Route::get('student-attendance/batch-report/pdf',[StudentAttendanceController::class, 'exportBatchPdf'])->name('admin.student-attendance.batch-report.pdf');

// });


// Route::get('/register', [UserController::class, 'create'])-> name('auth.register');
// Route::post('/register', [UserController::class, 'store'])-> name('auth.store');
// Route::get('/', [LoginController::class, 'showLoginForm'])-> name('auth.login');
Route::get('/', function () {return view('auth.login');})->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [LoginController::class, 'logoutAndRedirect'])->name('logout');
Route::post('/login-check', [LoginController::class, 'login'])-> name('auth.login.check');

// Route::get('/search', [SearchController::class, 'index'])->name('admin.search');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/register', [UserController::class, 'create'])->name('auth.register');
Route::post('/register', [UserController::class, 'store'])->name('auth.store');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    /* Dashboard */
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    /* Admin Management */
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::post('/admins/update/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('/admins/delete/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.delete');

    /* Students */
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('admin.students.store');
        Route::get('/view/{id}', [StudentController::class, 'show'])->name('admin.students.view');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
        Route::post('/update/{id}', [StudentController::class, 'update'])->name('admin.students.update');
        Route::get('/delete/{id}', [StudentController::class, 'delete'])->name('admin.students.delete');
    });

    /* Teachers */
    Route::prefix('teachers')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
        Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
        Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
        Route::get('/view/{id}', [TeacherController::class, 'view'])->name('admin.teachers.view');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
        Route::post('/update/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
        Route::get('/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teachers.delete');

    });

    /* Courses */
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/store', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/view/{id}', [CourseController::class, 'view'])->name('admin.courses.view');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::get('/delete/{id}', [CourseController::class, 'delete'])->name('admin.courses.delete');
    });

    /* Course Types */
    Route::prefix('course-types')->group(function () {
        Route::get('/', [CourseTypeController::class, 'index'])->name('admin.course-types.index');
        Route::get('/create', [CourseTypeController::class, 'create'])->name('admin.course-types.create');
        Route::post('/store', [CourseTypeController::class, 'store'])->name('admin.course-types.store');
        Route::get('/view/{courseType}', [CourseTypeController::class, 'view'])->name('admin.course-types.view');
        Route::get('/edit/{courseType}', [CourseTypeController::class, 'edit'])->name('admin.course-types.edit');
        Route::post('/update/{courseType}', [CourseTypeController::class, 'update'])->name('admin.course-types.update');
        Route::get('/delete/{courseType}', [CourseTypeController::class, 'delete'])->name('admin.course-types.delete');
    });

    /* Batches */
    Route::prefix('batches')->group(function () {
        Route::get('/', [BatchController::class, 'index'])->name('admin.batches.index');
        Route::get('/create', [BatchController::class, 'create'])->name('admin.batches.create');
        Route::post('/store', [BatchController::class, 'store'])->name('admin.batches.store');
        Route::get('/view/{id}', [BatchController::class, 'show'])->name('admin.batches.view');
        Route::get('/edit/{id}', [BatchController::class, 'edit'])->name('admin.batches.edit');
        Route::post('/update/{id}', [BatchController::class, 'update'])->name('admin.batches.update');
        Route::get('/delete/{id}', [BatchController::class, 'delete'])->name('admin.batches.delete');
    });

    /* Teacher Assignments */
    Route::prefix('teacher-assignments')->group(function () {
        Route::get('/', [TeacherAssignmentController::class, 'index'])->name('admin.teacher-assignments.index');
        Route::get('/create', [TeacherAssignmentController::class, 'create'])->name('admin.teacher-assignments.create');
        Route::post('/store', [TeacherAssignmentController::class, 'store'])->name('admin.teacher-assignments.store');
        Route::get('/edit/{assignment}', [TeacherAssignmentController::class, 'edit'])->name('admin.teacher-assignments.edit');
        Route::post('/update/{assignment}', [TeacherAssignmentController::class, 'update'])->name('admin.teacher-assignments.update');
        Route::get('/delete/{assignment}', [TeacherAssignmentController::class, 'delete'])->name('admin.teacher-assignments.delete');
    });

    /* Subjects */
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('admin.subjects.index');
        Route::get('/create', [SubjectController::class, 'create'])->name('admin.subjects.create');
        Route::post('/store', [SubjectController::class, 'store'])->name('admin.subjects.store');
        Route::get('/view/{id}', [SubjectController::class, 'show'])->name('admin.subjects.view');
        Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('admin.subjects.edit');
        Route::post('/update/{id}', [SubjectController::class, 'update'])->name('admin.subjects.update');
        Route::get('/delete/{id}', [SubjectController::class, 'delete'])->name('admin.subjects.delete');
    });

    /* Student Enrollment */
    Route::prefix('student-enrollment')->group(function () {
        Route::get('/', [StudentEnrollmentController::class, 'index'])->name('admin.student-enrollment.index');
        Route::get('/create', [StudentEnrollmentController::class, 'create'])->name('admin.student-enrollment.create');
        Route::post('/store', [StudentEnrollmentController::class, 'store'])->name('admin.student-enrollment.store');
        Route::get('/edit/{studentId}', [StudentEnrollmentController::class, 'edit'])->name('admin.student-enrollment.edit');
        Route::post('/update/{studentId}', [StudentEnrollmentController::class, 'update'])->name('admin.student-enrollment.update');
        Route::get('/delete/{student}', [StudentEnrollmentController::class, 'destroy'])->name('admin.student-enrollment.delete');
    });

    /* Student Attendance */
    Route::prefix('student-attendance')->group(function () {
        Route::get('/', [StudentAttendanceController::class, 'index'])->name('admin.student-attendance.index');
        Route::get('/create', [StudentAttendanceController::class, 'create'])->name('admin.student-attendance.create');
        Route::post('/store', [StudentAttendanceController::class, 'store'])->name('admin.student-attendance.store');
        Route::get('/edit/{batch}/{date}', [StudentAttendanceController::class, 'edit'])->name('admin.student-attendance.edit');
        Route::put('/update/{batch}/{date}', [StudentAttendanceController::class, 'update'])->name('admin.student-attendance.update');
        Route::get('/delete/{batch}/{date}', [StudentAttendanceController::class, 'destroy'])->name('admin.student-attendance.delete');

        Route::get('/report', [StudentAttendanceController::class, 'report'])->name('admin.student-attendance.report');
        Route::get('/batch-report', [StudentAttendanceController::class, 'batchReport'])->name('admin.student-attendance.batch-report');
        Route::get('/batch-report/excel', [StudentAttendanceController::class, 'exportBatchExcel'])->name('admin.student-attendance.batch-report.excel');
        Route::get('/batch-report/pdf', [StudentAttendanceController::class, 'exportBatchPdf'])->name('admin.student-attendance.batch-report.pdf');
    });

    /* Teacher Attendance */
    Route::prefix('teacher-attendance')->group(function () {
        Route::get('/', [TeacherAttendanceController::class, 'index'])->name('admin.teacher-attendance.index');
        Route::get('/create', [TeacherAttendanceController::class, 'create'])->name('admin.teacher-attendance.create');
        Route::post('/store', [TeacherAttendanceController::class, 'store'])->name('admin.teacher-attendance.store');
        Route::get('/edit/{id}', [TeacherAttendanceController::class, 'edit'])->name('admin.teacher-attendance.edit');
        Route::put('/update/{batch}/{date}', [TeacherAttendanceController::class, 'update'])->name('admin.teacher-attendance.update');
        Route::delete('/delete/{teacherAttendance}', [TeacherAttendanceController::class, 'destroy'])->name('admin.teacher-attendance.delete');
        Route::get('/report', [TeacherAttendanceController::class, 'report'])->name('admin.teacher-attendance.report');
        Route::get('/export-excel', [TeacherAttendanceController::class, 'exportExcel'])->name('admin.teacher-attendance.export.excel');
        Route::get('/export-pdf', [TeacherAttendanceController::class, 'exportPdf'])->name('admin.teacher-attendance.export.pdf');
    });

    /* Search */
    Route::get('/search', [SearchController::class, 'index'])->name('admin.search');
});

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'studentDashboard'])
        ->name('student.dashboard');
});

/*
|--------------------------------------------------------------------------
| TEACHER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/batches', [BatchController::class, 'batches'])->name('teacher.batches');
    Route::get('/subjects', [SubjectController::class, 'subjects'])->name('teacher.subjects');

    Route::get('/attendance', [TeacherAttendance::class, 'index'])->name('teacher.attendance.index');
    Route::get('/attendance/create', [TeacherAttendance::class, 'create'])->name('teacher.attendance.create');
    Route::post('/attendance/store', [TeacherAttendance::class, 'store'])->name('teacher.attendance.store');

});
