<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CuentaAdministrativaController;
use App\Http\Controllers\AdministradorRegistroController;
use App\Http\Controllers\RestriccionController;
use App\Http\Controllers\CorreoDominioRestringidoController;

Route::get('/', function () {
    return view('acceso_portal');
});

Route::get('/administradores/restricciones/correos', [CorreoDominioRestringidoController::class, 'create'])->name('administrador.restriccion.correo');
Route::post('/administradores/restricciones/correos', [CorreoDominioRestringidoController::class, 'store'])->name('administrador.restriccion.correo.post');
Route::get('/administradores/restricciones/correos/{id}/edit', [CorreoDominioRestringidoController::class, 'edit'])->name('administrador.restriccion.correo.edit');
Route::put('/administradores/restricciones/correos/{id}', [CorreoDominioRestringidoController::class, 'update'])->name('administrador.restriccion.put');

Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');


Route::get('/administradores/login', [CuentaAdministrativaController::class, 'formulario_login'])->name('administrador.login');
Route::post('/administradores/login', [CuentaAdministrativaController::class, 'login'])->name('administrador.login.post')->middleware('throttle:5,1');

Route::middleware(['auth', 'ensure.superuser'])->group(function () 
{
    Route::get('/administradores/register', [CuentaAdministrativaController::class, 'create'])->name('administrador.register');
    Route::post('/administradores/register', [CuentaAdministrativaController::class, 'store'])->name('administrador.register.post')->middleware('throttle:5,1');
});

Route::middleware('auth:web')->group(function () 
{
    Route::get('/administradores/dashboard', function() 
    {
        return view('administradores.dashboard');
    })->name('administrador.dashboard');

    Route::get('/administradores/restricciones', [RestriccionController::class, 'index'])->name('administrador.restriccion');
});

Route::post('/administradores/logout', [CuentaAdministrativaController::class, 'logout'])->name('administrador.logout')->middleware('auth');



Route::delete('correos/{id}', [CorreoDominioRestringidoController::class, 'destroy'])->name('correos.destroy');


