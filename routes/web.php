<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentDashboardController;

Route::get('/', [LoginController::class, 'showLoginForm']);

Route::get('/student/dashboard', [StudentDashboardController::class, 'StudentDashboard']);
Route::get('/student/promissory-note-form', [StudentDashboardController::class, 'PromissoryNote']);
Route::get('/student/status-tracking', [StudentDashboardController::class, 'StatusTracking']);
Route::get('/student/payment-history', [StudentDashboardController::class, 'PaymentHistory']);
