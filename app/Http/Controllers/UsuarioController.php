<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $reglas = 
        [
            'nombre'   => ['required', 'min:3', 'max:50', 'regex:/^[\p{L}\s\'\.-]+$/u'],
            'correo'   => 
            [
                'required', 
                'min:5',
                'max:150', 
                'unique:usuarios,correo_electronico', 
                'regex:/^(?=.*[a-z])[A-Za-z0-9._%+\-]+@(?=[A-Za-z0-9\.-]*[a-z])(?:[A-Za-z0-9-]+\.)+[A-Za-z]{2,}$/'
            ],
            'telefono' => ['required', 'regex:/^\d{10}$/'],
        ];

        $mensajes = 
        [
            'nombre.required'    => 'Debes ingresar el nombre del usuario.',
            'nombre.min'         => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max'         => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.regex'       => 'El nombre solo puede contener letras, espacios, apóstrofes, puntos y guiones.',

            'correo.required'    => 'Debes ingresar el correo electrónico.',
            'correo.max'         => 'El correo no puede tener más de 150 caracteres.',
            'correo.unique'      => 'Ese correo ya está registrado.',
            'correo.regex'       => 'El formato del correo es incorrecto, evite usar solo mayúsculas.',

            'telefono.required'  => 'Debes ingresar el teléfono.',
            'telefono.regex'     => 'El teléfono debe contener exactamente 10 dígitos (solo números).',
        ];

        $validados = $request->validate($reglas, $mensajes);

        $datos = 
        [
            'nombre'            => $validados['nombre'],
            'correo_electronico'=> $validados['correo'],
            'telefono'          => $validados['telefono'],
            'fecha_creacion'    => Carbon::now()->toDateString(),
        ];

        Usuario::create($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
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
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate
        ([
            'nombre' => ['required', 'string', 'max:50'],
            'correo_electronico' => 
            [
                'required', 'email', 'max:150',
                'unique:usuarios,correo_electronico,' . $usuario->id . ',id',
            ],
            'telefono' => ['required', 'string', 'max:10'],
            'fecha_creacion' => ['required', 'date'],
        ]);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index');
    }
}
