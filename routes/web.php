<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;

Route::get('/', fn () => view('welcome'))->name('splash');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:login')->name('login.submit');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');

    Route::get('/attendance/overview', [AttendanceController::class, 'overview'])->name('attendance.overview');
    Route::get('/attendance/records', [AttendanceController::class, 'records'])->name('attendance.records');
    Route::get('/attendance/terminal', [AttendanceController::class, 'terminal'])->name('attendance.terminal');
    Route::get('/attendance/adjustments', [AttendanceController::class, 'adjustments'])->name('attendance.adjustments');

    Route::get('/payroll/overview', [PayrollController::class, 'overview'])->name('payroll.overview');
    Route::get('/payroll/periods', [PayrollController::class, 'periods'])->name('payroll.periods');
    Route::get('/payroll/records/{periodId}', [PayrollController::class, 'records'])->name('payroll.records');
    Route::get('/payroll/payslip/{periodId}/{employeeId}', [PayrollController::class, 'payslip'])->name('payroll.payslip');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
});
