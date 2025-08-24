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
    Route::view('/records', 'admin.records.index')->name('admin.records.index');
    Route::view('/admin/users', 'admin.users.index')->name('admin.users.index');
    Route::view('/payments', 'admin.placeholder')->name('admin.payments.index');
    Route::view('/records/export', 'admin.placeholder')->name('admin.records.export');
    Route::view('/records/{id}', 'admin.placeholder')->name('admin.records.show');
    Route::view('/users/{id}/edit', 'admin.placeholder')->name('admin.users.edit');
    Route::view('/users/{id}/destroy', 'admin.placeholder')->name('admin.users.destroy');
    Route::view('/users/create', 'admin.placeholder')->name('admin.users.store');
    Route::view('/downpayments', 'admin.downpayments')->name('admin.downpayments');

    Route::post('/promissory-notes/{note}/approve', [AdminPromissoryNoteController::class, 'approve'])->name('admin.pn.approve');
    Route::post('/promissory-notes/{note}/reject',  [AdminPromissoryNoteController::class, 'reject'])->name('admin.pn.reject');
});
