<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware([])->group(function () {
    Route::get('/', [AuthController::class, 'login_or_home'])->name('login_or_home');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/report', [AuthController::class, 'booking_report']);
});