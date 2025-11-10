<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaAdministrativa;
use Illuminate\Support\Facades\Auth;

class AdministradorRegistroController extends Controller
{
    public function formulario_register()
    {
        return view('administradores.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate
        ([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'correo_electronico' => 'required|email|max:150|unique:cuentas_administrativas,correo_electronico',
            'contraseña' => 'required|string|min:8|confirmed',
            'roles_id' => 'nullable|exists:roles,id'
        ]);

        $data['estatus'] = true;
        $admin = CuentaAdministrativa::crearDesdeArray($data);

        Auth::guard('admin')->loginUsingId($admin->id);
        $request->session()->regenerate();

        return redirect()->route('administrador.dashboard');
    }
}
