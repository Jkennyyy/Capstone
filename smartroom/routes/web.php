<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDataController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\ReservationController as ApiReservationController;
use App\Http\Controllers\Api\RoomAvailabilityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('frontend.landing');
});

Route::get('/landing', function () {
    return view('frontend.landing');
});

Route::get('/login', [PageController::class, 'login'])->name('auth.login');

Route::middleware('guest')->group(function (): void {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
    Route::get('/signup', [PageController::class, 'signup'])->name('auth.signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup.submit');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [AuthController::class, 'changePassword'])->name('password.change.submit');
});

Route::middleware(['auth', 'password.changed', 'role:faculty'])->group(function (): void {
    Route::get('/faculty_dashboard', [FacultyController::class, 'dashboard'])->name('faculty.dashboard');

    Route::get('/rooms', [FacultyController::class, 'rooms'])->name('faculty.rooms');
    Route::get('/rooms/export/csv', [FacultyController::class, 'exportRoomsCsv'])->name('faculty.rooms.export.csv');

    Route::get('/faculty-schedule', [ScheduleController::class, 'facultyIndex'])->name('faculty.schedule');
    Route::post('/faculty-schedule', [ScheduleController::class, 'facultyStore'])->name('faculty.schedule.store');
    Route::patch('/faculty-schedule/{schedule}/cancel', [ScheduleController::class, 'facultyCancel'])->name('faculty.schedule.cancel');

    Route::get('/faculty_schedule', [ScheduleController::class, 'facultyIndex']);

    Route::get('/ai-recommendations', function () {
        return view('frontend.faculty.ai-recommendations');
    });

    Route::get('/reports', [FacultyController::class, 'reports'])->name('faculty.reports');
    Route::get('/reports/export/csv', [FacultyController::class, 'exportReportsCsv'])->name('faculty.reports.export.csv');

    Route::prefix('api/v1')->group(function (): void {
        Route::get('/room-availability/check', [RoomAvailabilityController::class, 'check']);
        Route::get('/room-statuses', [RoomAvailabilityController::class, 'statuses']);

        Route::middleware('role:faculty')->group(function (): void {
            Route::post('/reservations', [ApiReservationController::class, 'store']);
            Route::patch('/reservations/{reservation}', [ApiReservationController::class, 'update']);
            Route::delete('/reservations/{reservation}', [ApiReservationController::class, 'destroy']);
        });
    });
});

Route::middleware(['auth', 'password.changed', 'role:admin'])->group(function (): void {
    Route::get('/dashboard', [AdminController::class, 'users'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'users'])->name('admin.dashboard');

    Route::get('/admin/classrooms', [ClassroomController::class, 'index'])->name('admin.classrooms');
    Route::get('/admin/classrooms/{id}', [ClassroomController::class, 'show'])->name('admin.classrooms.show');
    Route::post('/admin/classrooms', [ClassroomController::class, 'store'])->name('admin.classrooms.store');
    Route::match(['put', 'patch'], '/admin/classrooms/{classroom}', [ClassroomController::class, 'update'])->name('admin.classrooms.update');
    Route::delete('/admin/classrooms/{classroom}', [ClassroomController::class, 'destroy'])->name('admin.classrooms.destroy');

    Route::get('/admin/schedule', [ScheduleController::class, 'index'])->name('admin.schedule');
    Route::get('/admin/schedule/export/csv', [ScheduleController::class, 'exportCsv'])->name('admin.schedule.export.csv');
    Route::delete('/admin/schedule/bulk-delete', [ScheduleController::class, 'bulkDestroy'])->name('admin.schedule.bulk-destroy');
    Route::get('/admin/schedule/{id}', [ScheduleController::class, 'show'])->name('admin.schedule.show');
    Route::post('/admin/schedule', [ScheduleController::class, 'store'])->name('admin.schedule.store');
    Route::post('/admin/schedule/import/preview', [ScheduleController::class, 'importPreview'])->name('admin.schedule.import.preview');
    Route::post('/admin/schedule/import', [ScheduleController::class, 'importStore'])->name('admin.schedule.import.store');
    Route::match(['put', 'patch'], '/admin/schedule/{schedule}', [ScheduleController::class, 'update'])->name('admin.schedule.update');
    Route::delete('/admin/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('admin.schedule.destroy');

    Route::post('/admin/courses', [AdminDataController::class, 'storeCourse'])->name('admin.courses.store');
    Route::match(['put', 'patch'], '/admin/courses/{course}', [AdminDataController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/admin/courses/{course}', [AdminDataController::class, 'destroyCourse'])->name('admin.courses.destroy');

    Route::post('/admin/access-cards', [AdminDataController::class, 'storeAccessCard'])->name('admin.access-cards.store');
    Route::match(['put', 'patch'], '/admin/access-cards/{accessCard}', [AdminDataController::class, 'updateAccessCard'])->name('admin.access-cards.update');
    Route::delete('/admin/access-cards/{accessCard}', [AdminDataController::class, 'destroyAccessCard'])->name('admin.access-cards.destroy');

    Route::post('/admin/access-logs', [AdminDataController::class, 'storeAccessLog'])->name('admin.access-logs.store');
    Route::match(['put', 'patch'], '/admin/access-logs/{accessLog}', [AdminDataController::class, 'updateAccessLog'])->name('admin.access-logs.update');
    Route::delete('/admin/access-logs/{accessLog}', [AdminDataController::class, 'destroyAccessLog'])->name('admin.access-logs.destroy');

    Route::get('/smartlocking', [AdminController::class, 'smartlocking'])->name('smartlocking.index');
    Route::get('/smartlocking/{id}', [AdminController::class, 'smartlockingDetail'])->name('smartlocking.show');

    // Admin SmartLocking route for tab navigation
    Route::get('/admin/smartlocking', [AdminController::class, 'smartlocking'])->name('admin.smartlocking');

    // Access Logs screen
    Route::get('/admin/accessLogs', [AdminController::class, 'accessLogs'])->name('accessLogs');
    Route::get('/admin/accessLogs/export/{format}', [AdminController::class, 'exportAccessLogs'])->name('admin.accessLogs.export');
    Route::get('/admin/accessLogs/export/csv', [AdminController::class, 'exportAccessLogsCsv'])->name('admin.accessLogs.export.csv');

    // Admin Reports
    Route::get('/admin/reports', function () {
        return view('frontend.admin.reports');
    })->name('admin.reports');

    // Admin User Management
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/data', [AdminController::class, 'usersData'])->name('admin.users.data');
    Route::post('/admin/users', [AdminDataController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::match(['put', 'patch'], '/admin/users/{user}', [AdminDataController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminDataController::class, 'destroyUser'])->name('admin.users.destroy');
});

