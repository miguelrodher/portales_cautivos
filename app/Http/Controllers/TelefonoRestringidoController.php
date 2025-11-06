<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelefonoRestringido;

class TelefonoRestringidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $telefonos = TelefonoRestringido::all();
        return view('telefonos_restringidos.index', compact('telefonos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('telefonos_restringidos.create');
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
                'max:10',
                'unique:telefonos_restringidos,restriccion',
            ],
        ]);

        TelefonoRestringido::create($request->all());

        return redirect()->route('telefonos-restringidos.index');
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
    public function edit(TelefonoRestringido $telefono_restringido)
    {
        return view('telefonos_restringidos.edit', compact('telefono_restringido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TelefonoRestringido $telefono_restringido)
    {
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:10',
                'unique:telefonos_restringidos,restriccion,' . $telefono_restringido->id . ',id',
            ],
        ]);

        $telefono_restringido->update($request->all());

        return redirect()->route('telefonos-restringidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelefonoRestringido $telefono_restringido)
    {
        $telefono_restringido->delete();
        return redirect()->route('telefonos-restringidos.index');
    }
}
