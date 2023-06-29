<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Item;
use App\item_variacion;
use App\Product;
use App\Tienda;
use App\Variation;
use App\variacion;
use Illuminate\Support\Facades\DB;



class HomeVariacionesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function GetVariaciones($id)
    {

        $getVariaciones = Product::find($id)->variacion()->get();

        return $getVariaciones;
    }

    public function GetItemsDeLaVariacion($id)
    {
        $getItemsDeLaVariacion = variacion::find($id)->items()->get();

        return $getItemsDeLaVariacion;
    }

    public function NewVaration(Request $request)
    {

        $product_id = $request->product_id;

        $newVaration = new variacion();
        $newVaration->product_id = $product_id;

        $newVaration->save();

        return $newVaration->id;
    }

    public function SetItemVariacion(Request $request)
    {
        $variacion_id = $request->variacion_id;
        $product_id = $request->product_id;
        $items = json_decode($request->items);
        $array = [];
        $stringVariaciones = [];
        $stock = $request->stock;



        foreach ($items as $value) {
            $item_variacion = new item_variacion();
            $item_variacion->variacion_id = $variacion_id;
            $item_variacion->item_id = $value->id;
            $item_variacion->product_id = $product_id;
            $item_variacion->save();
            array_push($stringVariaciones, strtolower($value->nombre));
            $array[] = $item_variacion;
        }

        $toSave = implode(" ", $stringVariaciones);

        $variaciones = variacion::find($variacion_id);

        $variaciones->variaciones = $toSave;
        $variaciones->stock = $stock;

        $variaciones->save();



        return response($array);
    }

    public function DeleteVariacion(Request $request)
    {
        $variacion_id = $request->variacion_id;

        $variacion_delete = variacion::find($variacion_id);

        return $variacion_delete->delete();
    }

    public function UpdateStock(Request $request)
    {
        $variacion_id = $request->variacion_id;
        $stock = $request->stock;

        $updateStock = variacion::find($variacion_id);
        $updateStock->stock = $stock;

        return $updateStock->save();
    }




    /* 
    public function GetItems($id)
    {
        $res = DB::table('variations')
        ->join('items','variations.id','=','items.variation_id')
        ->where('variations.product_id','=',$id)
        ->select('variations.*','items.*')
        ->orderBy('items.variation_id')
        ->get();

        return $res;
    }
 */
}
