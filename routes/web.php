<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorSesionController;
use App\Http\Controllers\AdministradorRegistroController;

Route::get('/', function () {
    return view('acceso_portal');
});



Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

Route::get('/administradores/register', [AdministradorRegistroController::class, 'formulario_register'])->name('administrador.register');
Route::post('/administradores/register', [AdministradorRegistroController::class, 'register'])->name('administrador.register.post')->middleware('throttle:5,1');

Route::get('/administradores/login', [AdministradorSesionController::class, 'formulario_login'])->name('administrador.login');
Route::post('/administradores/login', [AdministradorSesionController::class, 'login'])->name('administrador.login.post')->middleware('throttle:5,1');

Route::middleware('auth:admin')->group(function () 
{
    Route::post('/administradores/logout', [AdministradorSesionController::class, 'logout'])->name('administrador.logout');
    Route::get('/administradores/dashboard', function() 
    {
        return view('administradores.dashboard');
    })->name('administrador.dashboard');
});

