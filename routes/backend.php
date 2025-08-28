<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;


Route::controller(DashboardController::class)->group(function () {
   Route::get('/dashboard', 'index')->name('dashboard');
});
