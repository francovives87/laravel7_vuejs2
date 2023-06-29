<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tienda;

class NuevasTiendasController extends Controller
{

    public function GetNuevasTiendas()
    {
        $NuevasTiendas = Tienda::all();

        return $NuevasTiendas;
    }
}