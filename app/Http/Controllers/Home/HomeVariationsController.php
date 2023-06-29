<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Item;
use App\Product;
use App\Tienda;
use App\Variation;

class HomeVariationsController extends Controller
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

    public function GetVariacionesDelProducto($id)
    {

        //CREAR LOGICA PARA COMPROBAR QUE EL TIENDA_ID
        //ES EL QUE PERTENECE A ESE USUARIO!
        $getVariacionesDelProducto = Product::find($id)->variation()->get();

        return $getVariacionesDelProducto;
    }

    public function CreateVariacion(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'nombre' => 'required',
        ]);

        $product_id = $request->product_id;
        $nombre = $request->nombre;
        $description = $request->description;

        $create_variation = new Variation();
        $create_variation->product_id = $product_id;
        $create_variation->nombre = $nombre;
        $create_variation->description = $description;

        return $create_variation->save();
    }

    public function UpdateVariation(Request $request)
    {
        $variation_id = $request->variation_id;
        $variation_nombre = $request->variation_nombre;
        $variation_description = $request->variation_description;

        $variation_edit = Variation::find($variation_id);
        $variation_edit->nombre = $variation_nombre;
        $variation_edit->description = $variation_description;

        return $variation_edit->save();
    }

    public function DeleteVariation(Request $request)
    {
        $variation_id = $request->variation_id;

        $variation_delete = Variation::find($variation_id);

        return $variation_delete->delete();
    }

    public function GetItemsOfVariation($variation_id)
    {
        $getItemsOfVaritions = Variation::find($variation_id)->item()->get();

        return $getItemsOfVaritions;
    }

    public function CreateItem(Request $request)
    {

        $variation_id = $request->variation_id;
        $item_nombre = $request->item_nombre;


        $create_item = new Item();
        $create_item->variation_id = $variation_id;
        $create_item->nombre = strtolower($item_nombre);

        return $create_item->save();
    }

    public function UpdateItem(Request $request)
    {

        $item_id = $request->item_id;
        $item_nombre = $request->item_nombre;

        $item_update = Item::find($item_id);

        $item_update->nombre = strtolower($item_nombre);

        return $item_update->save();
    }

    public function DeleteItem(Request $request)
    {
        $item_id = $request->item_id;

        $item_delete = Item::find($item_id);

        return $item_delete->delete();
    }
}
