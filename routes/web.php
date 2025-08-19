

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController; // ✅ Add this

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default login page
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Student routes
Route::prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'StudentDashboard'])->name('student.dashboard');
    Route::get('/promissory-note-form', [StudentDashboardController::class, 'PromissoryNote'])->name('student.promissory-note');
    Route::get('/status-tracking', [StudentDashboardController::class, 'StatusTracking'])->name('student.status-tracking');
    Route::get('/payment-history', [StudentDashboardController::class, 'PaymentHistory'])->name('student.payment-history');
});


Route::prefix('admin')->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'AdminDashboard'])->name('admin.dashboard');
    

});
Route::get('/admin/analytics', function () {
    return view('admin.analytics'); // resources/views/admin/analytics.blade.php
})->name('admin.analytics');