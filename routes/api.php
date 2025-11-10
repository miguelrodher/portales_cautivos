<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdministradorApiController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/administradores/register', [AdministradorApiController::class, 'register'])->middleware('throttle:5,1');
Route::post('/administradores/login', [AdministradorApiController::class, 'login'])->middleware('throttle:8,1');
Route::middleware('auth:sanctum')->post('/administradores/logout', [AdministradorApiController::class, 'logout']);

