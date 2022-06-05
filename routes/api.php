<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Base\AuthController;
use App\Http\Controllers\Api\Base\UserController;
use App\Http\Controllers\Api\Base\EventoController;
use App\Http\Controllers\Api\Base\EventoUsuariosController;
use App\Http\Controllers\Api\Base\EventoComentariosController;
use App\Http\Controllers\Api\Base\ContactoController;
use App\Http\Controllers\Api\Admin\AdminUserController;
use App\Http\Controllers\Api\Admin\AdminDeporteController;
use App\Http\Controllers\Api\Admin\AdminEventoController;
use App\Http\Controllers\Api\Admin\AdminEventoUsuariosController;
use App\Http\Controllers\Api\Admin\AdminEventoComentariosController;
use App\Http\Controllers\Api\Admin\AdminContactoController;
use App\Http\Controllers\Api\Admin\AdminLogsController;


// Sección Externa - Auth
Route::post("auth/login", [AuthController::class, 'login']);
Route::post("auth/register", [AuthController::class, 'register']);
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);

// Sección Interna
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
    Route::get('eventos', [EventoController::class, 'index']);
    Route::get('eventos/{id}', [EventoController::class, 'show']);
    Route::post('eventos', [EventoController::class, 'store']);
    Route::get('eventos-historial', [EventoController::class, 'historial']);
    Route::get('eventos-proximas', [EventoController::class, 'proximas']);

    // EventoUsuarios
    Route::get('eventos-usuarios', [EventoUsuariosController::class, 'index']);
    Route::post('eventos-usuarios', [EventoUsuariosController::class, 'store']);
    Route::delete('eventos-usuarios/{evento_id}/{user_id?}', [EventoUsuariosController::class, 'destroy']);

    // EventoComentarios
    Route::get('eventos-comentarios', [EventoComentariosController::class, 'index']);
    Route::post('eventos-comentarios', [EventoComentariosController::class, 'store']);

    //Contacto
    Route::post('contacto', [ContactoController::class, 'store']);
});

// Sección Administración
Route::group(["middleware" => "role:admin"], function () {
    Route::prefix('admin')->group(function () {

        // AdminUsers
        Route::apiResource('users', AdminUserController::class);
        Route::put('users-active/{id}', [AdminUserController::class, 'activar']);

        // AdminDeporte
        Route::apiResource('deportes', AdminDeporteController::class);
        Route::get('deportes-populares', [AdminDeporteController::class, 'masPopular']);

        // AdminEvento
        Route::apiResource('eventos', AdminEventoController::class);
        Route::get('eventos-ultimos', [AdminEventoController::class, 'ultimosCreados']);

        // AdminEventoUsuarios
        Route::apiResource('eventos-usuarios', AdminEventoUsuariosController::class);
        Route::get('eventos-usuarios-activos', [AdminEventoUsuariosController::class, 'masActivos']);

        // AdminEventoComentarios
        Route::apiResource('eventos-comentarios', AdminEventoComentariosController::class);

        // AdminContacto
        Route::get('contacto', [AdminContactoController::class, 'index']);
        Route::get('contacto/{id}', [AdminContactoController::class, 'show']);
        Route::get('contacto-ultimos', [AdminContactoController::class, 'ultimosMensajes']);

        // AdminLogsController
        Route::get('logs', [AdminLogsController::class, 'index']);
    });

});

