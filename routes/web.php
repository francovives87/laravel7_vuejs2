<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@index')->name('main');

/* Auth::routes(['verify' => true]); */

Route::prefix('cuenta')->group(function () {
  Auth::routes(['verify' => true]);
});

Route::resource('in_shopping_carts', 'CartProductController', [
  "only" => ['store', 'destroy']
]);

Route::get('/cuenta/home', 'HomeController@index')->name('home');

Route::get('/{nombre}', 'ShowTiendaController@index'); //Esta es para laravel

Route::get('/tienda/get/{nombre}', 'TiendaController@show'); //Obtengo la tienda para vuejs component home

Route::get('/carrito/count', 'ShowTiendaController@productsCount');

Route::get('/create/tienda', 'TiendaController@index')->name('create.tienda');

Route::post('/create/tienda/store', 'TiendaController@store');

//Dame carrito
Route::get('cart/get/{id}', 'CartProductController@get');
//dame productos del chango
Route::get('/cart/products/{cart_id}', 'CartProductController@getProductInCart');
//Count
Route::get('/cart/products/counts/{cart_id}', 'CartProductController@countProductsInCart');
//Borro producto del carrito
Route::delete('/cart/products/delete', 'CartProductController@destroy');


//PRODUCTS
Route::get('/products/get/{id}', 'ProductController@show');

//Categorias
Route::get('/categories/get/{id}', 'CategoriaController@getCategories'); //Devuelve los productos que hay en la categoria

//Amount
Route::get('/products/amount/{id}', 'ProductController@amount');

//Variations

//Variaciones
Route::get('/products/variacion/{id}', 'VariationController@Variaciones');

//buscamos la variacion_id
Route::post('/products/variaciones/check', 'CheckVariacionesController@CheckVariaciones');
//con la variacion_id buscamos el Stocl
Route::get('/products/variaciones/stock/{variacion_id}', 'CheckVariacionesController@CheckStock');

//CHECKOUT
Route::post('/checkout/create', 'ChekoutController@CreateOrden');



//Este serian atributos
Route::get('/products/variation/{id}', 'VariationController@GetVariaciones');
Route::get('/products/variation/item/{id}', 'VariationController@GetitemOnAtributos');


//Trabajamos aca con esta super consulta de sql
Route::get('/products/variation/product/{id}', 'VariationController@GetVariacionesEItemsPorProductId');

//Query 2
Route::get('/products/variation/product/query2/{id}', 'VariationController@Query2');

Route::get('/products/variation/product/query3/{id}', 'VariationController@Query3');


//MercadoPago Test

Route::get('/mp/test', 'MercadoPagoController@index');

Route::post('/mp/payment', 'MercadoPagoController@payment')->name('mp.payment');




//Home Controladores
//Get Tienda x del User

Route::get('/private/tienda/{id}', 'Home\HomeTiendaController@GetTiendaDelUser');
//Get categorias de la tienda x
Route::get('/cuenta/categorie/{id}', 'Home\HomeCategorieController@GetCategoriasDeTienda');

Route::post('/private/categorie/create', 'Home\HomeCategorieController@CreateCategorie');

Route::post('/cuenta/categoria/edit', 'Home\HomeCategorieController@updateCategorie');

Route::post('/cuenta/categoria/delete', 'Home\HomeCategorieController@deleteCategorie');

//Home Products

Route::get('/cuenta/product/{id}', 'Home\HomeProductController@GetProductsTienda');

Route::post('/cuenta/product/create', 'Home\HomeProductController@CreateProduct');

Route::post('/cuenta/product/edit', 'Home\HomeProductController@updateProduct');

Route::post('/cuenta/product/delete', 'Home\HomeProductController@DeleteProduct');
//Cuento si el producto tiene variaciones para saber si es un producto simple o con variaciones
Route::get('/cuenta/product/type/{id}', 'Home\HomeProductController@TipoDeProducto');



//Home Variations

//Variaciones Genericas
Route::get('/cuenta/gvariations/{id}', 'Home\HomeGvariationController@GetGVariations');
//Get items of variation
Route::get('/cuenta/gvariations/gitems/{id}', 'Home\HomeGvariationController@GetItemsOfGvariations');
//Gvartions
Route::post('/cuenta/gvariations/create', 'Home\HomeGvariationController@CreateGVariation');

Route::post('/cuenta/gvariations/edit', 'Home\HomeGvariationController@UpdateGVariation');

Route::post('/cuenta/gvariations/delete', 'Home\HomeGvariationController@DeleteGVariation');
//GItems
Route::post('/cuenta/gitem/create', 'Home\HomeGvariationController@CreateItem');

Route::post('/cuenta/gitem/edit', 'Home\HomeGvariationController@EditGItem');

Route::post('/cuenta/gitem/delete', 'Home\HomeGvariationController@DeleteGItem');

//Variaciones de Productos
Route::get('/cuenta/product/variations/{id}', 'Home\HomeVariationsController@GetVariacionesDelProducto');
//Creo atributo
Route::post('/cuenta/variations/create', 'Home\HomeVariationsController@CreateVariacion');
//Edit variation
Route::post('/cuenta/variations/edit', 'Home\HomeVariationsController@UpdateVariation');
//Borrar Variation
Route::post('/cuenta/variations/delete', 'Home\HomeVariationsController@DeleteVariation');
//Get items of variations
Route::get('/cuenta/product/variations/items/{id}', 'Home\HomeVariationsController@GetItemsOfVariation');
//Create Item of variation personalizada
Route::post('/cuenta/variations/items/create', 'Home\HomeVariationsController@CreateItem');
//Edit item of variation personalizada
Route::post('/cuenta/variations/items/edit', 'Home\HomeVariationsController@UpdateItem');
//Delete item of variation perzonalizada
Route::post('/cuenta/variations/items/delete', 'Home\HomeVariationsController@DeleteItem');

//VARIACIONES POSTAS!
//Get variaciones del producto:
Route::get('/cuenta/product/variaciones/{id}', 'Home\HomeVariacionesController@GetVariaciones');
//Get items de la variacion:
Route::get('/cuenta/product/variaciones/items/{id}', 'Home\HomeVariacionesController@GetItemsDeLaVariacion');
//Crear variacion
Route::post('/cuenta/variaciones/create', 'Home\HomeVariacionesController@NewVaration');
//Insertar items en la variacion
Route::post('/cuenta/variaciones/items/create', 'Home\HomeVariacionesController@SetItemVariacion');
//Delete Variacion
Route::post('/cuenta/variaciones/delete', 'Home\HomeVariacionesController@DeleteVariacion');
//Editar stock de la variacion
Route::post('/cuenta/variaciones/stock/edit', 'Home\HomeVariacionesController@UpdateStock');


//HOME PEDIDOS
//Obtengo la lista de pedidos segun la tienda
Route::get('/cuenta/pedidos/{tienda_id}', 'Home\HomePedidosController@ListarPedidos');



//MAIN
Route::get('/main/nuevas_tiendas/', 'Main\NuevasTiendasController@GetNuevasTiendas');















