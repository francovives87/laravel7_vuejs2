<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Tienda;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class HomeCategorieController extends Controller
{
    public $calidad_image = 70;
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

    public function GetCategoriasDeTienda($id)
    {

        //CREAR LOGICA PARA COMPROBAR QUE EL TIENDA_ID
        //ES EL QUE PERTENECE A ESE USUARIO!
        $getCategoriasDeTienda = Tienda::find($id)->categorias()->get();

        return $getCategoriasDeTienda;
    }

    public function CreateCategorie(Request $request)
    {
        $request->validate([
            'tienda_id' => 'required',
            'nombre' => 'required',
            'image' =>   'image',
        ]);
        $tienda_id = $request->tienda_id;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        //Obtengo el nombre de la tienda, para crear la carpeta de la tienda
        $nombreTienda = DB::table('tiendas')->where('id', '=', $tienda_id)->get();

        $carpeta = $nombreTienda[0]->nombre;


        $ruta_image = $request['image']->store($carpeta, 'public');

        Image::make(public_path("storage/{$ruta_image}"))
            ->fit(300, 300)
            ->save(public_path("storage/{$ruta_image}"),$this->calidad_image);


        $ruta_image_vue = '/storage/' . $ruta_image;

        $categoria = new Categoria();
        $categoria->tienda_id = $tienda_id;
        $categoria->nombre = $nombre;
        $categoria->descripcion = $descripcion;
        $categoria->image = $ruta_image_vue;

        return $categoria->save();
    }

    public function updateCategorie(Request $request)
    {

        $tienda_id = $request->tienda_id;
        //Obtengo el nombre de la tienda, para crear la carpeta de la tienda
        $nombreTienda = DB::table('tiendas')->where('id', '=', $tienda_id)->get();

        $carpeta = $nombreTienda[0]->nombre;

        $categorie_id = $request->categorie_id;
        $categorie_nombre = $request->categorie_nombre;
        $categorie_descripcion = $request->categorie_descripcion;

        $categorie_edit = Categoria::find($categorie_id);
        $categorie_edit->nombre = $categorie_nombre;
        $categorie_edit->descripcion = $categorie_descripcion;

        File::delete(public_path($categorie_edit->image));

        $ruta_image = $request['image']->store($carpeta, 'public');

        Image::make(public_path("storage/{$ruta_image}"))
            ->fit(300, 300)
            ->save(public_path("storage/{$ruta_image}"),$this->calidad_image);

        $ruta_image_vue = '/storage/' . $ruta_image;

        $categorie_edit->image = $ruta_image_vue;

        return $categorie_edit->save();
    }

    public function deleteCategorie(Request $request)
    {
        $categoria_id = $request->categorie_id;

        $categoria_delete = Categoria::find($categoria_id);
        File::delete(public_path($categoria_delete->image));

        return $categoria_delete->delete();
    }
}
