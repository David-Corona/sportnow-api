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
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/me', [UserController::class, 'update']);
    Route::put('users/me/avatar', [UserController::class, 'updateAvatar']);
    Route::put('users/me/password', [UserController::class, 'updatePassword']);

});

Route::group(["middleware" => "role:admin"], function () {

    // AdminUsers
    Route::get('admin/users', [AdminUserController::class, 'index']);
    Route::get('admin/users/{id}', [AdminUserController::class, 'show']);
    Route::put('admin/users/{id}', [AdminUserController::class, 'update']);
    Route::get('admin/users/{id}/{valor}',  [AdminUserController::class, 'activar']);
    Route::delete('admin/users/{id}', [AdminUserController::class, 'delete']);
});





