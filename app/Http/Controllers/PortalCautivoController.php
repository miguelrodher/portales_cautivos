<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortalCautivo;

class PortalCautivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portales = PortalCautivo::all();
        return view('portales_cautivos.index', compact('portales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portales_cautivos.create');
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
            'nombre' => ['required', 'string', 'max:100', 'unique:portales_cautivos,nombre'],
        ]);

        PortalCautivo::create($request->all());

        return redirect()->route('portales-cautivos.index');
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
    public function edit(PortalCautivo $portal_cautivo)
    {
        return view('portales_cautivos.edit', compact('portal_cautivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PortalCautivo $portal_cautivo)
    {
        $request->validate
        ([
            'nombre' => 
            [
                'required', 'string', 'max:100',
                'unique:portales_cautivos,nombre,' . $portal_cautivo->id . ',id',
            ],
        ]);

        $portal_cautivo->update($request->all());

        return redirect()->route('portales-cautivos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PortalCautivo $portal_cautivo)
    {
        $portal_cautivo->delete();
        return redirect()->route('portales-cautivos.index');
    }
}
