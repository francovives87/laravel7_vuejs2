<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function variation()
    {
        return $this->belongsTo('App\Variation');
    }
}
