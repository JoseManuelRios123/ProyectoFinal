<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas públicas que no requieren autenticación
Route::group(['prefix'=> 'v1', 'namespace => App\Http\Controllers','middleware'=>'auth:sanctum'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('asesores', AsesorController::class);
    Route::apiResource('proyectos', ProyectosController::class);
    Route::post('proyectos/bulk', [ProyectosController::class, 'bulkStore']);
});
