<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantAccount extends Model
{
    //PaymentMode
    public function unit(){
        
        return $this->belongsTo('App\Unit','for_house_no');
        
    }
    public function property(){
        
        return $this->belongsTo('App\Property','in_prop');
        
    }
    public function pymt_mode(){
        
        return $this->belongsTo('App\PaymentMode','payment_mode');
        
    }
    public function tenant(){
        
        //return $this->belongsTo('App\Tenant','tenant_id')->using('App\Unit','for_house_no');
        return $this->hasOneThrough(
            'App\Tenant',
            'App\Unit',
            'tenant_id', // Foreign key on units table...
            'in_unit_id' // Foreign key on tenants table...
        );
        
    }

}
