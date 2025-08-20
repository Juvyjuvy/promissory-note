

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntroPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController; // ✅ Add this

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// Intro page
Route::get('/', [IntroPageController::class, 'intropage'])->name('intro');

// login page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register page
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Student routes
Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'StudentDashboard'])->name('student.dashboard');
    Route::get('/promissory-note-form', [StudentDashboardController::class, 'PromissoryNote'])->name('student.promissory-note');
    Route::get('/status-tracking', [StudentDashboardController::class, 'StatusTracking'])->name('student.status-tracking');
    Route::get('/payment-history', [StudentDashboardController::class, 'PaymentHistory'])->name('student.payment-history');
});

Route::middleware(['auth'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'StudentDashboard'])->name('student.dashboard');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/analytics', [AdminDashboardController::class, 'AdminAnalytic'])->name('admin.analytics');
});
Route::prefix('admin')->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'AdminDashboard'])->name('admin.dashboard');
});
Route::get('/admin/analytics', [AdminDashboardController::class, 'AdminAnalytic'])->name('admin.analytics');
