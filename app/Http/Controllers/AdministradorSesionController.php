<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaAdministrativa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdministradorSesionController extends Controller
{
    public function formulario_login()
    {
        return view('administradores.login');
    }

    public function login(Request $request)
    {

        $data = $request->validate
        ([
            'correo_electronico' => 'required|email',
            'contraseña' => 'required|string'
        ]);

        $email = mb_strtolower($data['correo_electronico']);

        $admin = CuentaAdministrativa::whereRaw('lower(correo_electronico) = ?', [$email])->first();

        if (! $admin || ! Hash::check($data['contraseña'], $admin->getAuthPassword())) 
        {
            throw ValidationException::withMessages
            ([
                'correo_electronico' => ['Credenciales inválidas.'],
            ]);
        }

        if (! $admin->estatus) 
        {
            return back()->withErrors(['correo_electronico' => 'Cuenta desactivada.']);
        }

        Auth::guard('admin')->login($admin);

        $request->session()->regenerate();

        return redirect()->intended(route('administrador.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
