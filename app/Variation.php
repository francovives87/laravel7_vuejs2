<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    public function product()
    {
        return $this->belongsToMany('App\Product');
    }

    public function item()
    {
        return $this->hasMany('App\Item');
    }
}
