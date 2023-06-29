<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gitem extends Model
{
    public function gvariation()
    {
        return $this->belongsToMany('App\Gvariation');
    }
}
