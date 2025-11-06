<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SesionNavegador;

class SesionNavegadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesiones = SesionNavegador::all();
        return view('sesiones_navegadores.index', compact('sesiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sesiones_navegadores.create');
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
            'fecha_inicio' => ['required', 'date'],
            'fecha_cierre' => ['nullable', 'date'],
            'ip' => ['required', 'ip'],
            'dispositivo' => ['nullable', 'string', 'max:50'],
            'sistema_operativo' => ['nullable', 'string', 'max:20'],
            'version_sistema_operativo' => ['nullable', 'string', 'max:10'],
            'navegador' => ['nullable', 'string', 'max:20'],
            'version_navegador' => ['nullable', 'string', 'max:10'],
            'motor_navegador' => ['nullable', 'string', 'max:20'],
            'idioma' => ['nullable', 'string', 'max:20'],
            'eventos_cierres_sesiones_id' => ['nullable', 'integer', 'exists:eventos_cierres_sesiones,id'],
            'usuarios_id' => ['nullable', 'integer', 'exists:usuarios,id'],
            'portales_cautivos_id' => ['nullable', 'integer', 'exists:portales_cautivos,id'],
        ]);

        SesionNavegador::create($request->all());

        return redirect()->route('sesiones-navegadores.index');
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
    public function edit(SesionNavegador $sesion_navegador)
    {
        return view('sesiones_navegadores.edit', compact('sesion_navegador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SesionNavegador $sesion_navegador)
    {
        $request->validate
        ([
            'fecha_inicio' => ['required', 'date'],
            'fecha_cierre' => ['nullable', 'date'],
            'ip' => ['required', 'ip'],
            'dispositivo' => ['nullable', 'string', 'max:50'],
            'sistema_operativo' => ['nullable', 'string', 'max:20'],
            'version_sistema_operativo' => ['nullable', 'string', 'max:10'],
            'navegador' => ['nullable', 'string', 'max:20'],
            'version_navegador' => ['nullable', 'string', 'max:10'],
            'motor_navegador' => ['nullable', 'string', 'max:20'],
            'idioma' => ['nullable', 'string', 'max:20'],
            'eventos_cierres_sesiones_id' => ['nullable', 'integer', 'exists:eventos_cierres_sesiones,id'],
            'usuarios_id' => ['nullable', 'integer', 'exists:usuarios,id'],
            'portales_cautivos_id' => ['nullable', 'integer', 'exists:portales_cautivos,id'],
        ]);

        $sesion_navegador->update($request->all());

        return redirect()->route('sesiones-navegadores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SesionNavegador $sesion_navegador)
    {
        $sesion_navegador->delete();
        return redirect()->route('sesiones-navegadores.index');
    }
}
