<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoDispositivo;

class TipoDispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoDispositivo::all();
        return view('tipos_dispositivos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipos_dispositivos.create');
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
            'tipo_dispositivo' => 
            [
                'required',
                'string',
                'max:30',
                'unique:tipos_dispositivos,tipo_dispositivo',
            ],
        ]);

        TipoDispositivo::create($request->all());

        return redirect()->route('tipos-dispositivos.index');
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
    public function edit(TipoDispositivo $tipo_dispositivo)
    {
        return view('tipos_dispositivos.edit', compact('tipo_dispositivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDispositivo $tipo_dispositivo)
    {
        $request->validate
        ([
            'tipo_dispositivo' => 
            [
                'required',
                'string',
                'max:30',
                'unique:tipos_dispositivos,tipo_dispositivo,' . $tipo_dispositivo->id . ',id',
            ],
        ]);

        $tipo_dispositivo->update($request->all());

        return redirect()->route('tipos-dispositivos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDispositivo $tipo_dispositivo)
    {
        $tipo_dispositivo->delete();
        return redirect()->route('tipos-dispositivos.index');
    }
}
