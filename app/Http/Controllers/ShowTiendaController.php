<?php

namespace App\Http\Controllers;

use App\Tienda;
use App\ShoppingCart;
use Illuminate\Http\Request;
use App\Cart;
use App\MercadoPagoToken;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class ShowTiendaController extends Controller
{
    public function index(Request $request)
    {
        $hasTienda=1;
        $req = $request->nombre;

        $tienda = Tienda::with('productos', 'categorias', 'mercadoPagoToken')
            ->where('nombre', $req)
            ->first();

            if (Auth::check()) {
                $id = Auth::id();
                $user = User::find($id);
                $hasTienda = $user->tienda()->count();
            }
    

        //Para pasar por vue al carrito
        /*     $tienda_id = Tienda::all()->where('nombre', $req)->select('id'); */
        $tienda_id = DB::table('tiendas')->where('nombre', $req)->select('id')->get();

        if (empty($tienda['nombre'])) {
            return view('tiendafail');
        }
        //Mp Token

        if (empty($tienda->mercadoPagoToken->access_token)) {
            $mp_token = 'null';
        } else {
            $mp_token = $tienda->mercadoPagoToken->access_token;
        }


        $collecion = new Collection([

            'access_token' => $mp_token,
        ]);

        if ($request->wantsJson()) {
            /* return json_encode($collecion); */
            return $collecion->toJson(JSON_PRETTY_PRINT);
        }

        /*  return view('tienda')
            ->with( 'tienda', $tienda); //todo lo de la tienda */

        return view('main', ['hasTienda' => $hasTienda, 'tienda' => $tienda, 'tienda_id' => $tienda_id]);
    }
}
