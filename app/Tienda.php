<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $fillables=[
        'nombre','descripcion'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function productos() {
        return $this->hasMany('App\Product');
    }

    public function categorias() {
        return $this->hasMany('App\Categoria');
    }

    public function mercadoPagoToken() 
    {
        return $this->hasOne('App\MercadoPagoToken');
    }

    public function variaciones()
    {
        return $this->hasMany('App\Variation');
    }

    public function gvariations()
    {
        return $this->hasMany('App\Gvariation');
    }

    public function Ordenes(){
        return $this->hasMany('App\Orden');
    }
}
