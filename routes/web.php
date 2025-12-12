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
Route::get('/manage-student', [StudentController::class, 'index'])-> name('admin.managestudent');
Route::get('/add-student', [StudentController::class, 'create'])-> name('admin.addstudent');
Route::post('/store-student', [StudentController::class, 'store'])-> name('admin.storestudent');


Route::get('/register', [UserController::class, 'create'])-> name('auth.register');
Route::post('/save', [UserController::class, 'store'])-> name('auth.store');

