<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
