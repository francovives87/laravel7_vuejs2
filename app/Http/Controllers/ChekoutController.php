<?php

namespace App\Http\Controllers;

use App\Orden;
use App\Orden_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;



class ChekoutController extends Controller
{

    public function CreateOrden(Request $request)
    {
        $estadoItems = [];
        $tienda_id = $request->tienda_id;
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $pais = $request->pais;
        $direccion = $request->direccion;
        $apartamento = $request->apartamento;
        $ciudad = $request->ciudad;
        $provincia = $request->provincia;
        $codigopostal = $request->codigopostal;
        $telefono = $request->telefono;
        $email = $request->email;
        $notas = $request->notas;
        $metodo_pago = $request->metodo_pago;
        $total = $request->total;
        //Recibo la lista de productos
        $listaDeProductos = json_decode($request->listaDeProductos);

        $guardarDatosCliente = new Orden();
        $guardarDatosCliente->tienda_id = $tienda_id;
        $guardarDatosCliente->nombre = $nombre;
        $guardarDatosCliente->apellido = $apellido;
        $guardarDatosCliente->pais = $pais;
        $guardarDatosCliente->direccion = $direccion;
        $guardarDatosCliente->apartamento = $apartamento;
        $guardarDatosCliente->ciudad = $ciudad;
        $guardarDatosCliente->provincia = $provincia;
        $guardarDatosCliente->codigopostal = $codigopostal;
        $guardarDatosCliente->telefono = $telefono;
        $guardarDatosCliente->email = $email;
        $guardarDatosCliente->notas = $notas;
        $guardarDatosCliente->metodo_pago = $metodo_pago;
        $guardarDatosCliente->total = $total;
        
        $guardarDatosCliente->save();

        //Tomo el id_orden y guardo la lista de items en la base de datos
        foreach ($listaDeProductos as $item){
            $orden_item = new Orden_item();
            $orden_item->orden_id = $guardarDatosCliente->id;
            $orden_item->product_id = $item->id;
            $orden_item->variacion_id = $item->variacion_id;
            $orden_item->cantidad = $item->cantidad;
            $orden_item->save();
            array_push($estadoItems,$orden_item);
        }



        $collecion = new Collection([
            'DatosDelCliente' => $guardarDatosCliente,
            'ListaDeProductos' => $estadoItems,
        ]);

        return $collecion;
    }

    public function GuardarListaDeProductos(Request $request)
    {

        $listaDeProductos = json_decode($request->listaDeProductos);

        return $listaDeProductos;
    }
}
