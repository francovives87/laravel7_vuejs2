<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function Productos()
    {
        return $this->belongsToMany('App\Product');
    }

    public function products(){
        return $this->hasMany('App\Product');
      
    }
}
