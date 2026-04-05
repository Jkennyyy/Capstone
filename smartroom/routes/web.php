<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SmartLockingController;

Route::get('/', function () {
    return view('frontend.landing');
});

Route::get('/landing', function () {
    return view('frontend.landing');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/signup', function () {
    return view('auth.signup');
});
Route::get('/faculty_dashboard', function () {
    return view('frontend.faculty.faculty_dashboard');
});
Route::get('/rooms', function () {
    return view('frontend.faculty.rooms');
});

Route::get('/faculty-schedule', function () {
    return view('frontend.faculty.schedule');
})->name('faculty.schedule');

Route::get('/faculty_schedule', function () {
    return view('frontend.faculty.schedule');
});

Route::get('/dashboard', function () {
    return view('frontend.admin.dashboard');
});

Route::get('/ai-recommendations', function () {
    return view('frontend.faculty.ai-recommendations');
});

Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])->name('classrooms.show');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');


Route::get('/smartlocking', [SmartLockingController::class, 'index'])->name('smartlocking.index');
Route::get('/smartlocking/{id}', [SmartLockingController::class, 'show'])->name('smartlocking.show');

// Admin SmartLocking route for tab navigation
Route::get('/admin/smartlocking', [SmartLockingController::class, 'index'])->name('admin.smartlocking');

// Access Logs screen
Route::get('/admin/accessLogs', function () {
    return view('frontend.admin.accessLogs');
})->name('accessLogs');
