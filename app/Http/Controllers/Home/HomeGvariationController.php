<?php

namespace App\Http\Controllers\Home;

use App\Gitem;
use App\Gvariation;
use App\Tienda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeGvariationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function GetGVariations($id)
    {
        $getGVariations = Tienda::find($id)->gvariations()->get();

        return $getGVariations;
    }

    public function GetItemsOfGvariations($gvariation_id)
    {
        $getItemsOfGvariations = Gvariation::find($gvariation_id)->gitems()->get();

        return $getItemsOfGvariations;
    }

    public function CreateGVariation(Request $request)
    {
        $request->validate([
            'tienda_id' => 'required',
            'nombre' => 'required',
        ]);

        $tienda_id = $request->tienda_id;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;

        $gvariation = new Gvariation();
        $gvariation->tienda_id = $tienda_id;
        $gvariation->nombre = $nombre;
        $gvariation->description = $descripcion;

        return $gvariation->save();
    }

    public function UpdateGVariation(Request $request)
    {
        $gvariation_id = $request->gvariation_id;
        $gvariation_nombre = $request->variNombreUpdate;
        $gvariation_descripcion = $request->varidescriptionUpdate;

        $gvariation_edit = Gvariation::find($gvariation_id);
        $gvariation_edit->nombre = $gvariation_nombre;
        $gvariation_edit->description = $gvariation_descripcion;

        return $gvariation_edit->save();
    }

    public function DeleteGVariation(Request $request)
    {
        $gvariation_id = $request->gvariation_id;

        $gvariation_delete = Gvariation::find($gvariation_id);

        return $gvariation_delete->delete();
    }


    public function CreateItem(Request $request)
    {
        $request->validate([
            'gvariation_id' => 'required',
            'gitem_nombre' => 'required',
        ]);

        $gvariation_id = $request->gvariation_id;
        $gitem_nombre = $request->gitem_nombre;

        $createItem = new Gitem();
        $createItem->gvariation_id = $gvariation_id;
        $createItem->nombre = $gitem_nombre;

        return $createItem->save();
    }

    public function EditGItem(Request $request)
    {

        $gitem_id = $request->gitem_id;
        $gitem_nombre = $request->gitem_nombre;


        $gitem_edit = Gitem::find($gitem_id);
        $gitem_edit->nombre = $gitem_nombre;

        return $gitem_edit->save();
    }

    public function DeleteGItem(Request $request)
    {
        $gitem_id = $request->gitem_id;

        $gitem_delete = Gitem::find($gitem_id);

        return $gitem_delete->delete();
    }
}
