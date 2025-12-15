<?php

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Teacher\TeacherController;
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

Route::get('/', [AdminController::class, 'dashboard'])-> name('admin.dashboard');

Route::prefix('student')->group(function(){
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
    Route::get('/', [App\Http\Controllers\Course\CourseController::class, 'index'])-> name('admin.courses.index');
    Route::get('/create', [App\Http\Controllers\Course\CourseController::class, 'create'])-> name('admin.courses.create');
    Route::post('/store', [App\Http\Controllers\Course\CourseController::class, 'store'])-> name('admin.courses.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Course\CourseController::class, 'edit'])-> name('admin.courses.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Course\CourseController::class, 'update'])-> name('admin.courses.update');
});

Route::prefix('course-types')->group(function(){
    Route::get('/', [App\Http\Controllers\Course\CourseTypeController::class, 'index'])-> name('admin.course-types.index');
    Route::get('/create', [App\Http\Controllers\Course\CourseTypeController::class, 'create'])-> name('admin.course-types.create');
    Route::post('/store', [App\Http\Controllers\Course\CourseTypeController::class, 'store'])-> name('admin.course-types.store');
    Route::get('/edit/{id}', [App\Http\Controllers\Course\CourseTypeController::class, 'edit'])-> name('admin.course-types.edit');
    Route::post('/update/{id}', [App\Http\Controllers\Course\CourseTypeController::class, 'update'])-> name('admin.course-types.update');
});

Route::prefix('attendance')->group(function(){
    Route::get('/student', [App\Http\Controllers\Attendance\StudentAttendanceController::class, 'index'])-> name('admin.attendance.student.index');
    Route::get('/student/create', [App\Http\Controllers\Attendance\StudentAttendanceController::class, 'create'])-> name('admin.attendance.student.create');
    Route::post('/student/store', [App\Http\Controllers\Attendance\StudentAttendanceController::class, 'store'])-> name('admin.attendance.student.store');
});


Route::get('/register', [UserController::class, 'create'])-> name('register');
Route::post('/register', [UserController::class, 'store'])-> name('store');

