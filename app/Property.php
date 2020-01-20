<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    public function units(){
        return $this->hasMany('App\Unit','in_property');
    }
}
