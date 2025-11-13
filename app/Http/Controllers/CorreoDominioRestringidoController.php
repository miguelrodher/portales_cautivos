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
        return view('restricciones.correos.create');
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

        return redirect()->route('administrador.restriccion');
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
    public function edit($id)
    {
        $restriccion = CorreoDominioRestringido::findOrFail($id);
        return view('restricciones.correos.edit', compact('restriccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = (int) $id;

        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:100',
                'unique:correos_dominios_restringidos,restriccion,' . $id . ',id',
            ],
        ]);

        $model = CorreoDominioRestringido::findOrFail($id);
        $model->restriccion = trim($request['restriccion']);
        $model->save();

        return redirect()->route('administrador.restriccion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CorreoDominioRestringido::findOrFail($id);
        $item->delete();

        return redirect()->route('administrador.restriccion');
    }
}
