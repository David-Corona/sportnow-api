<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Base
use App\Http\Controllers\Api\Base\AuthController;
use App\Http\Controllers\Api\Base\UserController;

// User
// use App\Http\Controllers\Api\User\;

// Admin
use App\Http\Controllers\Api\Admin\AdminUserController;





// Auth
Route::post("auth/login", [AuthController::class, 'login']);
Route::post("auth/register", [AuthController::class, 'register']);
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);


Route::group(["middleware" => "role:user,admin"], function () {

    // Auth
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::get('auth/refresh', [AuthController::class, 'refresh']);
    Route::get('auth/logout', [AuthController::class, 'logout']);


    // Users
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/me', [UserController::class, 'me']);
    Route::put('users/me', [UserController::class, 'update']);
    // Route::put('users/me/avatar', [UserController::class, 'avatar']);
    // Route::put('users/me/password', [UserController::class, 'password']);
    Route::get('users/{id}', [UserController::class, 'show']);


});





