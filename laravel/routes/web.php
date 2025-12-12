<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\AdminController as SuperAdminAdminController;
use App\Http\Controllers\SuperAdmin\FieldController as SuperAdminFieldController;
use App\Http\Controllers\SuperAdmin\ScheduleController as SuperAdminScheduleController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Customer Routes
Route::middleware(['auth', 'check.active'])->group(function () {
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/fields', [CustomerDashboardController::class, 'fields'])->name('fields');
        Route::get('/field/{fieldId}', [CustomerDashboardController::class, 'fieldDetails'])->name('field-details');
        Route::get('/booking/form/{fieldId}', [CustomerDashboardController::class, 'showBookingForm'])->name('booking-form');
        Route::post('/booking', [CustomerDashboardController::class, 'storeBooking'])->name('store-booking');
        Route::get('/payment/{bookingId}', [CustomerDashboardController::class, 'showPaymentForm'])->name('payment-form');
        Route::post('/payment/{bookingId}', [CustomerDashboardController::class, 'storePaymentProof'])->name('store-payment');
        Route::get('/booking-history', [CustomerDashboardController::class, 'bookingHistory'])->name('booking-history');
        Route::get('/notifications', [CustomerDashboardController::class, 'notifications'])->name('notifications');
        Route::post('/notification/{notificationId}/read', [CustomerDashboardController::class, 'markNotificationRead'])->name('mark-notification-read');
    });
});

// Admin Routes
Route::middleware(['auth', 'check.active', 'check.role:admin,super_admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pending-bookings', [AdminDashboardController::class, 'pendingBookings'])->name('pending-bookings');
        Route::get('/booking/{bookingId}', [AdminDashboardController::class, 'bookingDetails'])->name('booking-details');
        Route::post('/booking/{bookingId}/approve', [AdminDashboardController::class, 'approveBooking'])->name('approve-booking');
        Route::post('/booking/{bookingId}/reject', [AdminDashboardController::class, 'rejectBooking'])->name('reject-booking');
        Route::post('/booking/{bookingId}/status', [AdminBookingController::class, 'updateStatus'])->name('update-booking-status');
        Route::delete('/booking/{bookingId}', [AdminBookingController::class, 'delete'])->name('delete-booking');
        
        Route::get('/pending-payments', [AdminDashboardController::class, 'pendingPayments'])->name('pending-payments');
        Route::get('/payment/{paymentId}', [AdminDashboardController::class, 'paymentDetails'])->name('payment-details');
        Route::post('/payment/{paymentId}/verify', [AdminDashboardController::class, 'verifyPayment'])->name('verify-payment');
        Route::post('/payment/{paymentId}/reject', [AdminDashboardController::class, 'rejectPayment'])->name('reject-payment');
        
        Route::get('/all-bookings', [AdminDashboardController::class, 'allBookings'])->name('all-bookings');
    });
});

// Super Admin Routes
Route::middleware(['auth', 'check.active', 'check.role:super_admin'])->group(function () {
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/revenue-report', [SuperAdminDashboardController::class, 'revenueReport'])->name('revenue-report');
        Route::get('/transaction-report', [SuperAdminDashboardController::class, 'transactionReport'])->name('transaction-report');
        Route::get('/usage-report', [SuperAdminDashboardController::class, 'usageReport'])->name('usage-report');
        
        // Admin Management
        Route::prefix('admins')->name('admins.')->group(function () {
            Route::get('/', [SuperAdminAdminController::class, 'index'])->name('index');
            Route::get('/create', [SuperAdminAdminController::class, 'create'])->name('create');
            Route::post('/', [SuperAdminAdminController::class, 'store'])->name('store');
            Route::get('/{adminId}/edit', [SuperAdminAdminController::class, 'edit'])->name('edit');
            Route::put('/{adminId}', [SuperAdminAdminController::class, 'update'])->name('update');
            Route::delete('/{adminId}', [SuperAdminAdminController::class, 'delete'])->name('delete');
        });
        
        // Field Management
        Route::prefix('fields')->name('fields.')->group(function () {
            Route::get('/', [SuperAdminFieldController::class, 'index'])->name('index');
            Route::get('/create', [SuperAdminFieldController::class, 'create'])->name('create');
            Route::post('/', [SuperAdminFieldController::class, 'store'])->name('store');
            Route::get('/{fieldId}/edit', [SuperAdminFieldController::class, 'edit'])->name('edit');
            Route::put('/{fieldId}', [SuperAdminFieldController::class, 'update'])->name('update');
            Route::delete('/{fieldId}', [SuperAdminFieldController::class, 'delete'])->name('delete');
        });
        
        // Schedule Management
        Route::prefix('schedules')->name('schedules.')->group(function () {
            Route::get('/', [SuperAdminScheduleController::class, 'index'])->name('index');
            Route::get('/create', [SuperAdminScheduleController::class, 'create'])->name('create');
            Route::post('/', [SuperAdminScheduleController::class, 'store'])->name('store');
            Route::get('/{scheduleId}/edit', [SuperAdminScheduleController::class, 'edit'])->name('edit');
            Route::put('/{scheduleId}', [SuperAdminScheduleController::class, 'update'])->name('update');
            Route::delete('/{scheduleId}', [SuperAdminScheduleController::class, 'delete'])->name('delete');
        });
    });
});

// Home route
Route::get('/', function () {
    return view('index');
})->name('home');
