<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function tienda() {
        return $this->belongsTo(Tieda::class);
    }

    public function carts() 
    {
        return $this->belongsToMany('App\Cart')->withPivot('amount');
    }


    public function categoria()
    {
        return $this->belongsTo('App\Categoria','categoria_id','id');
    }

    public function cart_product()
    {
        return $this->belongsToMany('App\Cart')->withPivot('amount');
    }

    public function variation()
    {
        return $this->hasMany('App\Variation');
    }

    public function variacion()
    {
        return $this->hasMany('App\variacion');
    }
   
}
