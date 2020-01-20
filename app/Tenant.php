<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    public function property(){
        
        return $this->belongsTo('App\Property','in_property_id');

    }
    public function unit(){
       
       return $this->belongsTo('App\Unit','in_unit_id');
       
   }
}
