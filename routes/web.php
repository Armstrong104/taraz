<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});
