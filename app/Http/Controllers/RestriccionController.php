<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorreoDominioRestringido;
use App\Models\NombreRestringido;
use App\Models\TelefonoRestringido;

class RestriccionController extends Controller
{
    public function index()
    {
        $nombres = NombreRestringido::all();
        $telefonos = TelefonoRestringido::all();
        $correos = CorreoDominioRestringido::all();
        return view('restricciones.index', compact('nombres', 'telefonos', 'correos'));
    }
}
