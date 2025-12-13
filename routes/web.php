<?php

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;

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



Route::get('/register', [UserController::class, 'create'])-> name('register');
Route::post('/register', [UserController::class, 'store'])-> name('store');

