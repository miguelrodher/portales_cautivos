<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermisoSuperUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Acceso denegado. Usuario no autenticado.');
        }

        $rol = $user->rol()->select('rol')->first();
        $rolName = $rol->rol ?? null;

        $rolNameNormalized = is_string($rolName) ? strtolower(trim($rolName)) : null;

        if ($rolNameNormalized !== 'superusuario') 
        {
            abort(403, 'Acceso denegado. Solo los usuarios con rol super_admin pueden acceder.');
        }

        return $next($request);
    }
}
