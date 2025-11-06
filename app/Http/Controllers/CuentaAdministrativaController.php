<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CuentaAdministrativa;
use App\Models\Role;

class CuentaAdministrativaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = CuentaAdministrativa::with('role')->get();
        return view('cuentas_administrativas.index', compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('cuentas_administrativas.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate
        ([
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['required', 'string', 'max:50'],
            'contraseña' => ['required', 'string', 'min:8'],
            'correo_electronico' => ['required', 'email', 'max:150', 'unique:cuentas_administrativas,correo_electronico'],
            'estatus' => ['nullable', 'boolean'],
            'roles_id' => ['nullable', 'integer', 'exists:roles,id'],
        ]);

        $data = $request->all();

        CuentaAdministrativa::create($data);

        return redirect()->route('cuentas-administrativas.index');
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
}
