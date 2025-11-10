<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaAdministrativa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdministradorApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'correo_electronico' => 'required|email|max:150|unique:cuentas_administrativas,correo_electronico',
            'contraseña' => 'required|string|min:8|confirmed',
            'roles_id' => 'nullable|exists:roles,id'
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $data = $validator->validated();

        $admin = \App\Models\CuentaAdministrativa::crearDesdeArray($data);

        $token = $admin->createToken('api-token')->plainTextToken;

        return response()->json(['admin' => $admin->makeHidden(['contraseña']), 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate
        ([
            'correo_electronico' => 'required|email',
            'contraseña' => 'required'
        ]);

        $email = mb_strtolower($request->correo_electronico);

        $admin = CuentaAdministrativa::whereRaw('lower(correo_electronico) = ?', [$email])->first();

        if (! $admin || ! Hash::check($request->contraseña, $admin->getAuthPassword())) 
        {
            throw ValidationException::withMessages
            ([
                'correo_electronico' => ['Credenciales inválidas.'],
            ]);
        }

        if (! $admin->estatus) 
        {
            return response()->json(['message' => 'Cuenta desactivada.'], 403);
        }

        $token = $admin->createToken('api-token')->plainTextToken;

        return response()->json(['admin' => $admin->makeHidden(['contraseña']), 'token' => $token]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) 
        {
            $request->user()->currentAccessToken()->delete();
        }
        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }
}
