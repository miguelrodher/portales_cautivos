<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorreoDominioRestringido;

class CorreoDominioRestringidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restricciones = CorreoDominioRestringido::all();
        return view('correos_dominios_restringidos.index', compact('restricciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('correos_dominios_restringidos.create');
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
            'restriccion' => 
            [
                'required',
                'string',
                'max:100',
                'unique:correos_dominios_restringidos,restriccion',
            ],
        ]);

        CorreoDominioRestringido::create($request->all());

        return redirect()->route('correos-dominios-restringidos.index');
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
    public function edit(CorreoDominioRestringido $correo_dominio_restringido)
    {
        return view('correos_dominios_restringidos.edit', compact('correo_dominio_restringido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CorreoDominioRestringido $correo_dominio_restringido)
    {
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:100',
                'unique:correos_dominios_restringidos,restriccion,' . $correo_dominio_restringido->id . ',id',
            ],
        ]);

        $correo_dominio_restringido->update($request->all());

        return redirect()->route('correos-dominios-restringidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CorreoDominioRestringido $correo_dominio_restringido)
    {
        $correo_dominio_restringido->delete();
        return redirect()->route('correos-dominios-restringidos.index');
    }
}
