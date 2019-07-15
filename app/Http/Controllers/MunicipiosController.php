<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipios;

class MunicipiosController extends Controller
{
    public function index(){
        return Municipios::all();
    }
}
