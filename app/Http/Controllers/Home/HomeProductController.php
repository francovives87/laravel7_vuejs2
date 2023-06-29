<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Product;
use App\Tienda;

class HomeProductController extends Controller
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

    public function GetProductsTienda($id)
    {

        //CREAR LOGICA PARA COMPROBAR QUE EL TIENDA_ID
        //ES EL QUE PERTENECE A ESE USUARIO!
        $res = DB::table('products')
            ->join('categorias', 'products.categoria_id', '=', 'categorias.id')
            ->where('products.tienda_id', '=', $id)
            ->select('products.*', 'categorias.nombre as nombreCategoria')
            ->orderBy('products.created_at', 'DESC')
            ->get();

        return $res;
    }

    public function TipoDeProducto($id)
    {
        $contarVariaciones = Product::find($id)->variacion()->count();

        return $contarVariaciones;
    }


    public function CreateProduct(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required',
            'tienda_id' => 'required',
            'nombre' => 'required',
            'precio' => 'required'
        ]);


        $tienda_id = $request->tienda_id;
        //Obtengo el nombre de la tienda, para crear la carpeta de la tienda
        $nombreTienda = DB::table('tiendas')->where('id', '=', $tienda_id)->get();

        $carpeta = $nombreTienda[0]->nombre;

        $ruta_image = $request['image']->store($carpeta, 'public');

        Image::make(public_path("storage/{$ruta_image}"))
            ->fit(640, 480)
            ->save(public_path("storage/{$ruta_image}"), $this->calidad_image);


        $ruta_image_vue = '/storage/' . $ruta_image;

        $categoria_id = $request->categoria_id;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $precio = $request->precio;

        $product = new Product();
        $product->categoria_id = $categoria_id;
        $product->tienda_id = $tienda_id;
        $product->nombre = $nombre;
        $product->descripcion = $descripcion;
        $product->precio = $precio;
        $product->img = $ruta_image_vue;

        return $product->save();
    }

    public function updateProduct(Request $request)
    {
        $tienda_id = $request->tienda_id;
        //Obtengo el nombre de la tienda, para crear la carpeta de la tienda
        $nombreTienda = DB::table('tiendas')->where('id', '=', $tienda_id)->get();

        $carpeta = $nombreTienda[0]->nombre;

        $product_id = $request->product_id;
        $product_categorie_id = $request->product_categorie_id;
        $product_nombre = $request->product_nombre;
        $product_descripcion = $request->product_descripcion;
        $product_precio = $request->product_precio;


        $product_edit = Product::find($product_id);
        $product_edit->nombre = $product_nombre;
        $product_edit->descripcion = $product_descripcion;
        $product_edit->categoria_id = $product_categorie_id;
        $product_edit->precio = $product_precio;

        File::delete(public_path($product_edit->img));

        $ruta_image = $request['image']->store($carpeta, 'public');

        Image::make(public_path("storage/{$ruta_image}"))
            ->fit(640, 480)
            ->save(public_path("storage/{$ruta_image}"), $this->calidad_image);

        $ruta_image_vue = '/storage/' . $ruta_image;

        $product_edit->img = $ruta_image_vue;

        return $product_edit->save();
    }

    public function DeleteProduct(Request $request)
    {
        $product_id = $request->product_id;

        $product_delete = Product::find($product_id);
        File::delete(public_path($product_delete->img));

        return $product_delete->delete();
    }
}
