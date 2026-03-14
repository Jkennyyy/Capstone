<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.landing');
});

Route::get('/landing', function () {
    return view('frontend.landing');
});
