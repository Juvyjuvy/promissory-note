<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IntroPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPromissoryNoteController;
use App\Http\Controllers\PromissoryNoteController;
use App\Http\Controllers\StudentNotificationController;

// ------------------------- Public -------------------------
Route::get('/', [IntroPageController::class, 'intropage'])->name('intro');

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// ------------------------- Student -------------------------
Route::middleware(['auth'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'StudentDashboard'])->name('student.dashboard');
    Route::get('/promissory-note-form', [StudentDashboardController::class, 'PromissoryNote'])->name('student.promissory-note');
    Route::get('/status-tracking', [StudentDashboardController::class, 'StatusTracking'])->name('student.status-tracking');
    Route::get('/payment-history', [StudentDashboardController::class, 'PaymentHistory'])->name('student.payment-history');

    // submit
    Route::post('/promissory-note-submit', [PromissoryNoteController::class, 'store'])->name('promissory-notes.store');

    // notifications
    Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('student.notifications');
    Route::post('/notifications/{id}/read', [StudentNotificationController::class, 'markRead'])->name('student.notifications.read');
});

// ------------------------- Admin -------------------------
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/analytics', [AdminDashboardController::class, 'AdminAnalytic'])->name('admin.analytics');

    Route::post('/promissory-notes/{note}/approve', [AdminPromissoryNoteController::class, 'approve'])->name('admin.pn.approve');
    Route::post('/promissory-notes/{note}/reject',  [AdminPromissoryNoteController::class, 'reject'])->name('admin.pn.reject');
});
