<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
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

    public function ordenes(){

        $orders = Orden::orderBy('id','DESC');

        return Datatables::of($orders)
            ->addColumn('btn', function ($orders) {
                return '
                <a class="btn btn-primary btn-sm"  href="#/suscripcion-web/' . $orders->id . '">
                  <i class="fa fa-eye"></i>
                </a>
                <a class="btn btn-danger btn-sm"  href="eliminar_suscripcion/' . $orders->id . '"  onclick="return confirm(\'¿ Desea eliminar el registro seleccionado ?\')">
                  <i class="fa fa-trash"></i>
                </a>';
            })
             ->rawColumns(['btn'])
             ->make(true);
    }

    public function detalle($id){

      return Orden::find($id);
    }
}
