<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Base\AuthController;

use App\Http\Controllers\Api\User\UserAuthController;





Route::post("auth/login", [AuthController::class, 'login']);
Route::post("auth/register", [AuthController::class, 'register']);
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);

Route::group(["middleware" => "auth"], function () {
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::get('auth/refresh', [AuthController::class, 'refresh']);
    Route::get('auth/logout', [AuthController::class, 'logout']);
});








