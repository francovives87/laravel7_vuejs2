<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class variacion extends Model
{
    public function items()
    {
        return $this->belongsToMany('App\Item','item_variacions');
    }
}
