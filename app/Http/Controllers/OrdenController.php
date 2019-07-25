<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Orden;
use App\Titular;

class OrdenController extends Controller
{
    public function store(Request $request){
        // Creando Titular
        $titular = new Titular();
        $titular->nombre = $request->nombre;
        $titular->apellido = $request->apellido;
        $titular->cedula = $request->cedula;
        $titular->tel = $request->tel;
        $titular->correo = $request->correo;
        $titular->save();
        // Creando Orden
        $orden = new Orden();
        $orden->estado = 'Pendiente';
        $orden->nombre = $request->nombre;
        $orden->apellido = $request->apellido;
        $orden->cedula = $request->cedula;
        $orden->tel = $request->tel;
        $orden->correo = $request->correo;
        $orden->tiempo = $request->tiempo;
        $orden->oracional = $request->oracional;
        $orden->municipio = $request->municipio;
        $orden->direccion = $request->direccion;
        $orden->valor = $request->valor;
        $orden->titular_id = $titular->id;
        $orden->save();

        return $request;
    }
}
