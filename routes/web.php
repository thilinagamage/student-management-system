<?php

use App\Http\Controllers\Academic\StudentEnrollmentController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Attendance\StudentAttendanceController;
use App\Http\Controllers\Course\BatchController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\CourseTypeController;
use App\Http\Controllers\Course\SubjectController;
use App\Http\Controllers\Course\TeacherAssignmentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Attendance\TeacherAttendanceController;
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



Route::get('/admin', [AdminController::class, 'dashboard'])-> name('admin.dashboard');

Route::prefix('student')->group(function(){
Route::middleware('auth:student')->group(function(){
        Route::get('/dashboard', [AdminController::class, 'studentDashboard'])-> name('student.dashboard');
    });

    Route::get('/', [StudentController::class, 'index'])-> name('admin.students.index');
    Route::get('/create', [StudentController::class, 'create'])-> name('admin.students.create');
    Route::post('/save', [StudentController::class, 'store'])-> name('admin.students.store');
    Route::get('/delete/{id}', [StudentController::class, 'delete'])-> name('admin.students.delete');
    Route::get('/edit/{id}', [StudentController::class, 'edit'])-> name('admin.students.edit');
    Route::post('/update/{id}/update', [StudentController::class, 'update'])-> name('admin.students.update');
    Route::get('/view/{id}', [StudentController::class, 'show'])-> name('admin.students.view');

});

Route::prefix('admin/teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teachers.delete');
    Route::get('/view/{id}', [TeacherController::class, 'view'])->name('admin.teachers.view');
    Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::post('/update/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
});

Route::prefix('courses')->group(function(){
    Route::get('/', [CourseController::class, 'index'])-> name('admin.courses.index');
    Route::get('/create', [CourseController::class, 'create'])-> name('admin.courses.create');
    Route::post('/store', [CourseController::class, 'store'])-> name('admin.courses.store');
    Route::get('/edit/{id}', [CourseController::class, 'edit'])-> name('admin.courses.edit');
    Route::post('/update/{id}', [CourseController::class, 'update'])-> name('admin.courses.update');
    Route::get('/delete/{id}', [CourseController::class, 'delete'])-> name('admin.courses.delete');
    Route::get('/view/{id}', [CourseController::class, 'view'])-> name('admin.courses.view');
});

Route::prefix('course-types')->group(function(){
    Route::get('/', [CourseTypeController::class, 'index'])-> name('admin.course-types.index');
    Route::get('/create', [CourseTypeController::class, 'create'])-> name('admin.course-types.create');
    Route::post('/store', [CourseTypeController::class, 'store'])-> name('admin.course-types.store');
    Route::get('/edit/{courseType}', [CourseTypeController::class, 'edit'])-> name('admin.course-types.edit');
    Route::post('/update/{courseType}', [CourseTypeController::class, 'update'])-> name('admin.course-types.update');
    Route::get('/delete/{courseType}', [CourseTypeController::class, 'delete'])-> name('admin.course-types.delete');
    Route::get('/view/{courseType}', [CourseTypeController::class, 'view'])-> name('admin.course-types.view');
});

Route::prefix('batches')->group(function(){
    Route::get('/', [BatchController::class, 'index'])-> name('admin.batches.index');
    Route::get('/create', [BatchController::class, 'create'])-> name('admin.batches.create');
    Route::post('/store', [BatchController::class, 'store'])-> name('admin.batches.store');
    Route::get('/view/{id}', [BatchController::class, 'show'])-> name('admin.batches.view');
    Route::get('/edit/{id}', [BatchController::class, 'edit'])-> name('admin.batches.edit');
    Route::post('/update/{id}', [BatchController::class, 'update'])-> name('admin.batches.update');
    Route::get('/delete/{id}', [BatchController::class, 'delete'])-> name('admin.batches.delete');

    // Route::get('batches/{id}/assign-subjects',[BatchController::class, 'assignSubjects'])->name('admin.batches.assign-subjects');
    // Route::post('batches/{id}/assign-subjects',[BatchController::class, 'storeAssignedSubjects'])->name('admin.batches.assign-subjects.store');

    // Route::get('batches/{id}/assign-teachers',[BatchController::class, 'assignTeachers'])->name('admin.batches.assign-teachers');
    // Route::post('batches/{id}/assign-teachers',[BatchController::class, 'storeAssignedTeachers'])->name('admin.batches.assign-teachers.store');
    // Route::get('batches/{batch}/subjects',[BatchController::class, 'subjectsByBatch'])->name('batches.subjects');


});

Route::prefix('teacher-assignments')->group(function () {
    Route::get('/',[TeacherAssignmentController::class, 'index'])->name('admin.teacher-assignments.index');
    Route::get('/create',[TeacherAssignmentController::class, 'create'])->name('admin.teacher-assignments.create');
    Route::post('/',[TeacherAssignmentController::class, 'store'])->name('admin.teacher-assignments.store');
    Route::get('/{assignment}/edit',[TeacherAssignmentController::class, 'edit'])->name('admin.teacher-assignments.edit');
    Route::post('/{assignment}',[TeacherAssignmentController::class, 'update'])->name('admin.teacher-assignments.update');
    Route::get('delete/{assignment}',[TeacherAssignmentController::class, 'delete'])->name('admin.teacher-assignments.delete');
});

Route::prefix('subjects')->group(function(){
    Route::get('/', [SubjectController::class, 'index'])-> name('admin.subjects.index');
    Route::get('/create', [SubjectController::class, 'create'])-> name('admin.subjects.create');
    Route::post('/store', [SubjectController::class, 'store'])-> name('admin.subjects.store');
    Route::get('/view/{id}', [SubjectController::class, 'show'])-> name('admin.subjects.view');
    Route::get('/edit/{id}', [SubjectController::class, 'edit'])-> name('admin.subjects.edit');
    Route::post('/update/{id}', [SubjectController::class, 'update'])-> name('admin.subjects.update');
    Route::get('/delete/{id}', [SubjectController::class, 'delete'])-> name('admin.subjects.delete');

});

Route::prefix('student-enrollment')->group(function(){
    Route::get('/', [StudentEnrollmentController::class, 'index'])->name('admin.student-enrollment.index');
    Route::get('/create', [StudentEnrollmentController::class, 'create'])->name('admin.student-enrollment.create');
    Route::post('/store', [StudentEnrollmentController::class, 'store'])->name('admin.student-enrollment.store');
    Route::get('/delete/{student}',[StudentEnrollmentController::class, 'destroy'])->name('admin.student-enrollment.delete');
    Route::get('/edit/{studentId}', [StudentEnrollmentController::class, 'edit'])->name('admin.student-enrollment.edit');
    Route::post('/update/{studentId}', [StudentEnrollmentController::class, 'update'])->name('admin.student-enrollment.update');

});

Route::prefix('student-attendance')->group(function(){
    Route::get('/create', [StudentAttendanceController::class, 'create'])->name('admin.student-attendance.create');
    Route::post('/store', [StudentAttendanceController::class, 'store'])->name('admin.student-attendance.store');
    Route::get('/', [StudentAttendanceController::class, 'index'])->name('admin.student-attendance.index');
    Route::get('student-attendance/{batch}/{date}/edit',[StudentAttendanceController::class, 'edit'])->name('admin.student-attendance.edit');
    Route::put('student-attendance/{batch}/{date}',[StudentAttendanceController::class, 'update'])->name('admin.student-attendance.update');
    Route::get('delete/{batch}/{date}', [StudentAttendanceController::class, 'destroy'])->name('admin.student-attendance.delete');
    Route::get('student-attendance/{attendance}',[StudentAttendanceController::class, 'destroySingle'])->name('admin.student-attendance.destroy.single');
    Route::get('student-attendance-report',[StudentAttendanceController::class, 'report'])->name('admin.student-attendance.report');
    Route::get('/batch-report',[StudentAttendanceController::class, 'batchReport'])->name('admin.student-attendance.batch-report');




});

Route::prefix('teacher-attendance')->group(function(){
    Route::get('/', [TeacherAttendanceController::class, 'index'])-> name('admin.teacher-attendance.index');
    Route::get('/create', [TeacherAttendanceController::class, 'create'])-> name('admin.teacher-attendance.create');
    Route::post('/store', [TeacherAttendanceController::class, 'store'])-> name('admin.teacher-attendance.store');
    Route::get('/edit/{id}',[TeacherAttendanceController::class, 'edit'])->name('admin.teacher-attendance.edit');
    Route::put('teacher-attendance/{batch}/{date}',[TeacherAttendanceController::class, 'update'])->name('admin.teacher-attendance.update');
    Route::delete('/delete/{teacherAttendance}', [TeacherAttendanceController::class, 'destroy'])-> name('admin.teacher-attendance.delete');
    Route::get('teacher-attendance-report',[TeacherAttendanceController::class, 'report'])->name('admin.teacher-attendance.report');
    Route::get('/teacher-attendance/export-excel',[TeacherAttendanceController::class, 'exportExcel'])->name('admin.teacher-attendance.export.excel');
    Route::get('teacher-attendance-export-pdf',[TeacherAttendanceController::class, 'exportPdf'])->name('admin.teacher-attendance.export.pdf');
    Route::get('student-attendance/batch-report/excel',[StudentAttendanceController::class, 'exportBatchExcel'])->name('admin.student-attendance.batch-report.excel');
    Route::get('student-attendance/batch-report/pdf',[StudentAttendanceController::class, 'exportBatchPdf'])->name('admin.student-attendance.batch-report.pdf');

});


Route::get('/register', [UserController::class, 'create'])-> name('auth.register');
Route::post('/register', [UserController::class, 'store'])-> name('auth.store');
Route::get('/', [LoginController::class, 'showLoginForm'])-> name('auth.login');
Route::post('/login-check', [LoginController::class, 'login'])-> name('auth.login.check');

Route::get('/search', [SearchController::class, 'index'])->name('admin.search');
