<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Base
use App\Http\Controllers\Api\Base\AuthController;
use App\Http\Controllers\Api\Base\UserController;
use App\Http\Controllers\Api\Base\EventoController;

// Admin
use App\Http\Controllers\Api\Admin\AdminUserController;
use App\Http\Controllers\Api\Admin\AdminDeporteController;
use App\Http\Controllers\Api\Admin\AdminEventoController;


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
    Route::put('users/me', [UserController::class, 'updateMe']);
    Route::put('users/me/avatar', [UserController::class, 'updateAvatar']);
    Route::put('users/me/password', [UserController::class, 'updatePassword']);

    // Evento
    // Route::apiResource('eventos', EventoController::class);
    Route::get('eventos', [EventoController::class, 'index']);
    Route::get('eventos/{id}', [EventoController::class, 'show']);
    Route::post('eventos', [EventoController::class, 'store']);
    // Route::put('eventos/{id}', [EventoController::class, 'update']);
    // Route::delete('eventos/{id}', [EventoController::class, 'destroy']);

});

Route::group(["middleware" => "role:admin"], function () {
    Route::prefix('admin')->group(function () {

        // AdminUsers
        Route::apiResource('users', AdminUserController::class);
        Route::put('users-active/{id}', [AdminUserController::class, 'activar']);

        // AdminDeporte
        Route::apiResource('deportes', AdminDeporteController::class);

        // AdminEvento
        Route::apiResource('eventos', AdminEventoController::class);

    });

});





