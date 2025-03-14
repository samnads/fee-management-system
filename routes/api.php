<?php

use App\Http\Controllers\ApiPaymentController;
use App\Http\Controllers\ApiStudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/students', ApiStudentController::class);
Route::get('/students/fees/{id}', [ApiStudentController::class, 'student_fee_details']);
Route::resource('/payments',ApiPaymentController::class);