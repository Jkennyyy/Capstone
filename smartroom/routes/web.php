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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/ai-recommendations', function () {
    return view('frontend.admin.ai-recommendations');
});

Route::get('/classrooms', [ClassroomController::class, 'index'])->name('classrooms.index');
Route::get('/classrooms/{id}', [ClassroomController::class, 'show'])->name('classrooms.show');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');

Route::get('/smartlocking', [SmartLockingController::class, 'index'])->name('smartlocking.index');
Route::get('/smartlocking/{id}', [SmartLockingController::class, 'show'])->name('smartlocking.show');
