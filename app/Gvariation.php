<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gvariation extends Model
{
 /*    public function gitems()
    {
        return $this->belongsToMany('App\Gitem');
    }
 */
    public function gitems()
    {
        return $this->hasMany('App\Gitem');
    }
}
