<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::middleware([AdminAuth::class])->group(function () {
    Route::get('/', [AuthController::class, 'login_or_home'])->name('login_or_home');
    Route::get('/report', [AuthController::class, 'booking_report']);
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::post('/students', [StudentController::class, 'save_student']);
    Route::post('/students/assign', [StudentController::class, 'assign_course']);
    Route::get('/students/{id}', [StudentController::class, 'student_data']);
    Route::post('/students/toggle', [StudentController::class, 'toggle']);
    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::post('/courses', [CourseController::class, 'save_course']);
    Route::post('/courses/toggle', [CourseController::class, 'toggle']);
    Route::get('/courses/{id}', [CourseController::class, 'course_data']);
    Route::put('/courses', [CourseController::class, 'update_course']);
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::post('/payments', [PaymentController::class, 'save_payment']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'login_view'])->name('login_view');