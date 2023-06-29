<?php

namespace App\Http\Controllers;

use App\Cart_Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartProductController extends Controller
{
    
    public function store(Request $request)
    {
        $in_shopping_cart = Cart_Product::create([
            'cart_id' => $request->shopping_cart_id,
            'product_id' => $request->producto_id
        ]);

        if ($in_shopping_cart) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors(['product' => 'No se pudo agregar el producto']);
    }

    public function get($id)
    {
        $getCart = Cart_Product::all()->where('cart_id', $id);
        return $getCart;
    }

    public function getProductInCart($cart_id)
    {
        $products = Cart::find($cart_id)->products()->get();
        return $products;
    }

    public function countProductsInCart($cart_id)
    {
        $count = Cart::find($cart_id)->products()->count();
        return $count;
    }

    public function destroy(Request $request)
    {

        $delete = Cart::find($request->cart_id)->products()->detach($request->product_id);
       return $delete;
        
        
    }
}
