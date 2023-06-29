<?php

namespace App\Http\Controllers;

use App\Product;
use App\variacion;
use App\Variation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariationController extends Controller
{


    //Variaciones
    public function Variaciones($id)
    {
        $variaciones = Product::find($id)->variacion()->get();

        return $variaciones;
    }

    //TRABAJANDO CON ATRIBUTOS
    public function GetitemOnAtributos($id)
    {
        $itemOnVartions = Variation::find($id)->item()->get();

        return $itemOnVartions;
    }


    public function GetVariaciones($id)
    {

        $getVariaciones = Product::find($id)
            ->variation()
            ->get();

        return $getVariaciones;
    }

    public function itemOnVaration($id)
    {
        $itemOnVartions = variacion::find($id)->items()->get();

        return $itemOnVartions;
    }



    /*  public function GetVariacionesEItemsPorProductId($id)
    {
         $getVariacionesEItemsPorProductId = Product::find($id)
                                            ->variacion()
                                            ->with('items')
                                            ->get();
 


          $getVariacionesEItemsPorProductId = DB::table('products')
            ->join('variacions', 'products.id', '=', 'variacions.product_id')
            ->join('item_variacions', 'variacions.id', '=', 'item_variacions.variacion_id')
            ->join('items', 'item_variacions.item_id', '=', 'items.id')
            ->where('variacions.product_id', '=', $id)
            ->select('items.nombre')
            ->groupBy('items.nombre')
            ->get();
        return $getVariacionesEItemsPorProductId; 
        $getVariacionesEItemsPorProductId = DB::table('variacions')
            ->join('item_variacions', 'variacions.id', '=', 'item_variacions.variacion_id')
            ->join('items', 'item_variacions.item_id', '=', 'items.id')
            ->join('variations', 'items.variation_id', '=', 'variations.id')
            ->where('variacions.product_id', '=', $id)
            ->select('variacion_id', 'items.nombre','variations.nombre as Atributo')
            ->orderBy('variacion_id')
            ->get();


        return $getVariacionesEItemsPorProductId;
    }


    public function Query2($id)
    {

        $query2 = DB::table('items')
            ->join('item_variacions', 'items.id', '=', 'item_variacions.item_id')
            ->join('variacions', 'item_variacions.variacion_id', '=', 'variacions.id')
            ->where('items.nombre', '=', $id)
            ->select('item_variacions.variacion_id', 'items.nombre')

            ->get();

        return $query2;
    }


    public function Query3($id)
    {
        $query3 = DB::table('item_variacions')
            ->select('item_variacions.variacion_id', 'item_variacions.item_id')
            ->where('variacion_id', '=', $id)
            ->groupBy('variacion_id', 'item_id')
            ->get();

        return $query3;
    } */
}
