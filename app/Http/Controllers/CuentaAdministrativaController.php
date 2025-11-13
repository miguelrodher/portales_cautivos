<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaAdministrativa;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CuentaAdministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = CuentaAdministrativa::with('rol')->get();
        return view('cuentas_administrativas.index', compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('administradores.register', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->guest() || (int) auth()->user()->roles_id !== 1) 
        {
            abort(403, 'Acceso denegado. No tienes los permisos necesarios.');
        }

        $fields = ['nombre', 'apellido_paterno', 'apellido_materno'];

        foreach ($fields as $f) 
        {
            if ($request->filled($f)) 
            {
                $val = $request->input($f);

                $val = trim(preg_replace('/\s+/u', ' ', $val));

                $request->merge([$f => $val]);
            }
        }

        $validated = $request->validate
        ([
            'nombre' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ.\s]+$/u'],
            'apellido_paterno' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ.\s]+$/u'],
            'apellido_materno' => ['required', 'min:3', 'max:50', 'regex:/^[A-Za-zñÑáéíóúÁÉÍÓÚ.\s]+$/u'],
            'contrasena' => ['required', 'string', 'min:12', 'max:72', 'confirmed'],
            'correo_electronico' => ['required', 'email:rfc,dns', 'min:5', 'max:150', 'unique:cuentas_administrativas,correo_electronico'],
            'roles_id' => ['required'],
        ], 
        [
            // mensajes para "nombre"
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede exceder 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras, acentos en vocales, puntos y espacios.',

            // mensajes para "apellido_paterno"
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_paterno.min' => 'El apellido paterno debe tener al menos 3 caracteres.',
            'apellido_paterno.max' => 'El apellido paterno no puede exceder 50 caracteres.',
            'apellido_paterno.regex' => 'El apellido paterno solo puede contener letras, acentos en vocales, puntos y espacios.',

            // mensajes para "apellido_materno"
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'apellido_materno.min' => 'El apellido materno debe tener al menos 3 caracteres.',
            'apellido_materno.max' => 'El apellido materno no puede exceder 50 caracteres.',
            'apellido_materno.regex' => 'El apellido materno solo puede contener letras, acentos en vocales, puntos y espacios.',

            // mensajes para "contrasena"
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.string' => 'La contraseña debe ser un texto válido.',
            'contrasena.min' => 'La contraseña debe tener al menos 12 caracteres.',
            'contrasena.max' => 'La contraseña no puede tener más de 72 caracteres.',
            'contrasena.confirmed' => 'La confirmación de la contraseña no coincide.',

            // mensajes para "correo_electronico"
            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email' => 'El correo electrónico debe ser una dirección válida (formato RFC).',
            'correo_electronico.min' => 'El correo electrónico debe tener al menos 5 caracteres.',
            'correo_electronico.max' => 'El correo electrónico no puede exceder 150 caracteres.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado en el sistema.',
        ]);

        foreach ($fields as $f) 
        {
            if (!empty($validated[$f])) 
            {
                $lower = mb_strtolower($validated[$f], 'UTF-8');

                $title = mb_convert_case($lower, MB_CASE_TITLE, 'UTF-8');

                $title = trim(preg_replace('/\s+/u', ' ', $title));

                $validated[$f] = $title;
            }
        }

        //dd($validated);

        $cuenta = CuentaAdministrativa::create
        ([
            'nombre' => $validated['nombre'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'contrasena' => Hash::make($validated['contrasena']),
            'correo_electronico' => $validated['correo_electronico'],
            'roles_id' => $validated['roles_id'],
            'estatus' => $validated['estatus'] ?? true,
        ]);

        return redirect()->route('administrador.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaAdministrativa $cuenta_administrativa)
    {
        $roles = Role::all();
        return view('cuentas_administrativas.edit', compact('cuenta_administrativa', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaAdministrativa $cuenta_administrativa)
    {
        $request->validate
        ([
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['required', 'string', 'max:50'],
            'contraseña' => ['nullable', 'string', 'min:8'],
            'correo_electronico' => 
            [
                'required', 'email', 'max:150',
                'unique:cuentas_administrativas,correo_electronico,' . $cuenta_administrativa->id . ',id',
            ],
            'estatus' => ['nullable', 'boolean'],
            'roles_id' => ['nullable', 'integer', 'exists:roles,id'],
        ]);

        $data = $request->all();

        if (empty($data['contrasena'])) 
        {
            unset($data['contrasena']);
        } 

        $cuenta_administrativa->update($data);

        return redirect()->route('cuentas-administrativas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaAdministrativa $cuenta_administrativa)
    {
        $cuenta_administrativa->delete();
        return redirect()->route('cuentas-administrativas.index');
    }


    /*Metodos de inicio y cierre de sesion*/

    public function login(Request $request)
    {
        $request->validate
        ([
            'correo_electronico' => ['required', 'email'],
            'contrasena' => ['required', 'string'],
        ]);

        $credentials = 
        [
            'correo_electronico' => $request->input('correo_electronico'),
            'password' => $request->input('contrasena')
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) 
        {
            $request->session()->regenerate();
            return redirect()->intended('/administradores/dashboard');
        }

        return back()->withErrors
        ([
            'correo_electronico' => 'Credenciales inválidas.',
        ])->withInput($request->only('correo_electronico'));
    }


    public function formulario_login()
    {
        return view('administradores.login');
    }


    public function logout(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('administrador.login')
                         ->with('status', 'Sesión cerrada correctamente.');
    }
}
