<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventoCierreSesion;

class EventoCierreSesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = EventoCierreSesion::all();
        return view('eventos_cierres_sesiones.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos_cierres_sesiones.create');
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
            'evento_cierre_sesion' => 
            [
                'required', 'string', 'max:50',
                'unique:eventos_cierres_sesiones,evento_cierre_sesion',
            ],
        ]);

        EventoCierreSesion::create($request->all());

        return redirect()->route('eventos-cierres-sesiones.index');
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
    public function edit(EventoCierreSesion $evento_cierre_sesion)
    {
        return view('eventos_cierres_sesiones.edit', compact('evento_cierre_sesion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventoCierreSesion $evento_cierre_sesion)
    {
        $request->validate
        ([
            'evento_cierre_sesion' => 
            [
                'required', 'string', 'max:50',
                'unique:eventos_cierres_sesiones,evento_cierre_sesion,' . $evento_cierre_sesion->id . ',id',
            ],
        ]);

        $evento_cierre_sesion->update($request->all());

        return redirect()->route('eventos-cierres-sesiones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventoCierreSesion $evento_cierre_sesion)
    {
        $evento_cierre_sesion->delete();
        return redirect()->route('eventos-cierres-sesiones.index');
    }
}
