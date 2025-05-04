<?php

use App\Livewire\Modules\UserModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


Route::get('user-module', UserModule::class)->name('user.module');
