<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dominio;

class DominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dominios = Dominio::all();
        return view('dominios.index', compact('dominios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dominios.create');
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
            'dominio' => 
            [
                'required',
                'string',
                'max:50',
                'unique:dominios,dominio',
            ],
        ]);

        Dominio::create($request->all());

        return redirect()->route('dominios.index');
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
    public function edit(Dominio $dominio)
    {
        return view('dominios.edit', compact('dominio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dominio $dominio)
    {
        $request->validate
        ([
            'dominio' => 
            [
                'required',
                'string',
                'max:50',
                'unique:dominios,dominio,' . $dominio->id . ',id',
            ],
        ]);

        $dominio->update($request->all());

        return redirect()->route('dominios.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dominio $dominio)
    {
        $dominio->delete();
        return redirect()->route('dominios.index');
    }
}
