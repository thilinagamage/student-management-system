<?php

use App\Http\Controllers\Admin\Academic\StudentEnrollmentController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Attendance\StudentAttendanceController;
use App\Http\Controllers\Admin\Course\BatchController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Course\CourseTypeController;
use App\Http\Controllers\Admin\Course\SubjectController;
use App\Http\Controllers\Admin\Course\TeacherAssignmentController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use App\Http\Controllers\Admin\Attendance\TeacherAttendanceController;
use App\Http\Controllers\Admin\Course\BatchSubjectController;
use App\Http\Controllers\Teacher\TeacherAttendanceController as TeacherAttendance;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Student\StudentSideEnrollmentController;
use App\Http\Controllers\Student\StudentAttendanceController as StudentAttendance;
use App\Http\Controllers\Teacher\TeacherTeacherController;
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


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [LoginController::class, 'logoutAndRedirect'])->name('logout');
Route::post('/login-check', [LoginController::class, 'login'])->name('auth.login.check');

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
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

    /* Admin Management */
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins/store', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admins/edit/{admin}', [AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('/admins/update/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('/admins/delete/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.delete');
    Route::get('/admins/view/{id}', [AdminController::class, 'show'])->name('admin.admins.view');


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
        Route::get('{batch}/assign-subjects', [BatchSubjectController::class, 'create'])->name('admin.batches.assign-subjects.create');
        Route::post('{batch}/assign-subjects', [BatchSubjectController::class, 'store'])->name('admin.batches.assign-subjects.store');
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
        Route::get('enrollments', [StudentEnrollmentController::class, 'studentEnrollmensShow'])->name('admin.enrollments.show');
        Route::post('enrollments/{enrollment}/approve', [StudentEnrollmentController::class, 'enrollmentApprove'])->name('admin.enrollments.approve');
        Route::post('enrollments/{enrollment}/cancel', [StudentEnrollmentController::class, 'enrollmentCancel'])->name('admin.enrollments.cancel');
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
        Route::put('/update/{attendance}', [TeacherAttendanceController::class, 'update'])->name('admin.teacher-attendance.update');

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

    Route::get('/dashboard', [StudentDashboard::class, 'studentDashboard'])->name('student.dashboard');
    Route::get('/enrollments', [StudentSideEnrollmentController::class, 'index'])->name('student.enrollments.index');
    Route::get('/enrollments/create', [StudentSideEnrollmentController::class, 'create'])->name('student.enrollments.create');
    Route::post('/enrollments', [StudentSideEnrollmentController::class, 'store'])->name('student.enrollments.store');
    Route::get('/attendance', [StudentAttendance::class, 'studentMyattendance'])->name('student.attendance.index');
});


/*
|--------------------------------------------------------------------------
| TEACHER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/batches', [TeacherTeacherController::class, 'myBatches'])->name('teacher.batches');
    // Route::get('/subjects', [TeacherController::class, 'subjects'])->name('teacher.subjects');


    Route::get('/my-attendance', [TeacherAttendance::class, 'index'])->name('teacher.teacher-attendance.index');
    Route::get('attendance/create', [TeacherAttendance::class, 'create'])->name('teacher.teacher-attendance.create');
    Route::post('attendance/store', [TeacherAttendance::class, 'store'])->name('teacher.teacher-attendance.store');
    Route::get('attendance', [TeacherAttendance::class, 'index'])->name('teacher.teacher-attendance.index');
    Route::get('attendance/edit/{batch}', [TeacherAttendance::class, 'edit'])->name('teacher.teacher-attendance.edit');
    // Route::post('attendance/update/{batch}/{date}', [TeacherAttendance::class, 'update'])->name('teacher.teacher-attendance.update');
    Route::post('teacher/attendance/update/{attendance}', [TeacherAttendance::class, 'update'])->name('teacher.teacher-attendance.update');
    Route::get('attendance/delete/{teacherAttendance}', [TeacherAttendance::class, 'destroy'])->name('teacher.teacher-attendance.delete');

    Route::get('/students-attendance', [StudentAttendance::class, 'index'])->name('teacher.student-attendance.index');
    Route::get('/students-attendance/create', [StudentAttendance::class, 'create'])->name('teacher.student-attendance.create');
    Route::post('/students-attendance/store', [StudentAttendance::class, 'store'])->name('teacher.student-attendance.store');
    Route::get('/students-attendance/{batch}/{date}/edit', [StudentAttendance::class, 'edit'])->name('teacher.student-attendance.edit');
    Route::put('/students-attendance/update/{batch}/{date}', [StudentAttendance::class, 'update'])->name('teacher.student-attendance.update');
    Route::get('/students-attendance/{attendance}', [StudentAttendance::class, 'destroy'])->name('teacher.student-attendance.delete');
    // Route::get('/attendance/get-students/{batch}',[TeacherAttendanceController::class, 'getStudents'])->name('teacher.attendance.get-students');

});
