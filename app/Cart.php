<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public static function findOrCreateById($shopping_cart_id)
    {
        if ($shopping_cart_id) {
            return Cart::find($shopping_cart_id);
        } else {
            return Cart::create();
        }
    }

    public function products() 
    {
        return $this->belongsToMany('App\Product')->withPivot('amount');
    }

    public function countProducts()
    {
        return $this->products()->count();
    }
}
