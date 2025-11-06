<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolesPermiso;
use App\Models\Role;
use App\Models\Permiso;

class RolPermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RolesPermiso::with(['role', 'permiso'])->get();
        return view('roles_permisos.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permisos = Permiso::all();
        return view('roles_permisos.create', compact('roles', 'permisos'));
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
            'roles_id' => ['required', 'integer', 'exists:roles,id'],
            'permisos_id' => ['required', 'integer', 'exists:permisos,id'],
        ]);

        $roles_id = $request->input('roles_id');
        $permisos_id = $request->input('permisos_id');

        $exists = RolesPermiso::where('roles_id', $roles_id)
                    ->where('permisos_id', $permisos_id)
                    ->exists();

        if ($exists) 
        {
            return redirect()->back()->withErrors(['duplicate' => 'La relación rol–permiso ya existe.'])->withInput();
        }

        RolesPermiso::create
        ([
            'roles_id' => $roles_id,
            'permisos_id' => $permisos_id,
        ]);

        return redirect()->route('roles-permisos.index');
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
    public function edit(RolesPermiso $rol_permiso)
    {
        $roles = Role::all();
        $permisos = Permiso::all();
        return view('roles_permisos.edit', compact('rol_permiso', 'roles', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolesPermiso $rol_permiso)
    {
        $request->validate
        ([
            'roles_id' => ['required', 'integer', 'exists:roles,id'],
            'permisos_id' => ['required', 'integer', 'exists:permisos,id'],
        ]);

        $roles_id = $request->input('roles_id');
        $permisos_id = $request->input('permisos_id');

        $exists = RolesPermiso::where('roles_id', $roles_id)
                    ->where('permisos_id', $permisos_id)
                    ->where('id', '!=', $rol_permiso->id)
                    ->exists();

        if ($exists) 
        {
            return redirect()->back()->withErrors(['duplicate' => 'La relación rol–permiso ya existe.'])->withInput();
        }

        $rol_permiso->update
        ([
            'roles_id' => $roles_id,
            'permisos_id' => $permisos_id,
        ]);

        return redirect()->route('roles-permisos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolesPermiso $rol_permiso)
    {
        $rol_permiso->delete();
        return redirect()->route('roles-permisos.index');
    }
}
