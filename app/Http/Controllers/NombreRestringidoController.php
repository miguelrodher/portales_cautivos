<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NombreRestringido;

class NombreRestringidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nombres = NombreRestringido::all();
        return view('nombres_restringidos.index', compact('nombres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nombres_restringidos.create');
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
                'max:50',
                'unique:nombres_restringidos,restriccion',
            ],
        ]);

        NombreRestringido::create($request->all());

        return redirect()->route('nombres-restringidos.index');
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
    public function edit(NombreRestringido $nombre_restringido)
    {
        return view('nombres_restringidos.edit', compact('nombre_restringido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NombreRestringido $nombre_restringido)
    {
        $request->validate
        ([
            'restriccion' => 
            [
                'required',
                'string',
                'max:50',
                'unique:nombres_restringidos,restriccion,' . $nombre_restringido->id . ',id',
            ],
        ]);

        $nombre_restringido->update($request->all());

        return redirect()->route('nombres-restringidos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NombreRestringido $nombre_restringido)
    {
        $nombre_restringido->delete();
        return redirect()->route('nombres-restringidos.index');
    }
}
