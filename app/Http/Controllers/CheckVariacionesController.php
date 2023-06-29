<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\item_variacion;
use App\variacion;

class CheckVariacionesController extends Controller
{

    public function CheckVariaciones(Request $request)
    {
        $product_id = $request->product_id;
        $items = json_decode($request->items);

        $res = DB::table('item_variacions')
            ->whereIn('item_id', $items)
            ->where('product_id', '=', $product_id)
            ->get();

        return $res;
    }

    public function CheckStock($variacion_id)
    {
        /*  $stock = DB::table('variacions')
            ->select('stock')
            ->where('id', '=', $variacion_id)
            ->get(); */

        $stock = variacion::where('id', $variacion_id)->select('stock')->get();

        return json_decode($stock);
    }
}
