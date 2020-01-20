<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    public function property(){
        
         return $this->belongsTo('App\Property','in_property');

     }
     public function unitType(){
        
        return $this->belongsTo('App\UnitType','unit_type');
        
    }
    public function tenant(){
        
        return $this->hasOne('App\Tenant','in_unit_id');
        
    }
}
