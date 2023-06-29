<?php

namespace App\Http\Controllers;

use App\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\TiendaCategories;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //carga vista de creacion de tienda
        //Cargo categorias de las tiendas
        $tiendaCategorias = TiendaCategories::orderBy('nombre')->get();


        if (Auth::check()) {
            $id = Auth::id();
            $user = User::find($id);
            $hasTienda = $user->tienda()->count();

            if ($hasTienda > 0) {
                return redirect('/cuenta/home');
            }
        }


        return view('tiendacreate', ['tiendaCategorias' => $tiendaCategorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Grabo la tienda en la base de datos

        $id = Auth::id();

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);



        $nombre = $request->nombre;
        //trabajo el nombre
        $quitoespacios = str_replace(' ', '', $nombre);
        $pasoAminusculas =  strtolower($quitoespacios);

        $nombre = $pasoAminusculas;

        $descripcion = $request->descripcion;
        $categoria = $request->categoria;
        $pais = $request->pais;
        $region = $request->region;
        $subregion = $request->subregion;
        $ciudad = $request->ciudad;
        $codigo_postal = $request->codigo_postal;
        $barrio = $request->barrio;
        $direccion = $request->direccion;
        $lat = $request->lat;
        $lng = $request->lng;
        $telefono = $request->telefono;


        $tienda = new Tienda();
        $tienda->user_id = $id;
        $tienda->nombre = $nombre;
        $tienda->categoria = $categoria;
        $tienda->descripcion = $descripcion;
        $tienda->categoria = $categoria;
        $tienda->telefono = $telefono;

        //Geolocalizacion
        $tienda->pais = $pais;
        $tienda->region = $region;
        $tienda->subregion = $subregion;
        $tienda->ciudad = $ciudad;
        $tienda->direccion = $direccion;
        $tienda->codigo_postal = $codigo_postal;
        $tienda->barrio = $barrio;
        $tienda->lat = $lat;
        $tienda->lng = $lng;

        $tienda->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $req = $request->nombre;

        $tienda = Tienda::with('productos', 'categorias', 'mercadoPagoToken')
            ->where('nombre', $req)
            ->first();

        return $tienda;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function edit(Tienda $tienda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tienda $tienda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tienda $tienda)
    {
        //
    }
}
