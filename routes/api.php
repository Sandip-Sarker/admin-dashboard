<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Profile\ProfileController;


Route::middleware('guest')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile-details', [ProfileController::class, 'profileDetails']);
});
