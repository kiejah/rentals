<?php

namespace App\Services\v1;
use App\Property;
use App\Unit;

class PropertiesService{
    protected $supported_includes=[
        'unit'=>'units',
    ];
    public function getProperties($parameters){

        if(empty($parameters)){
            return $this->filterProperties(Property::all());
        }

        $with_keys=[];
        if(isset($parameters['include'])){
            $include_params= explode(',',$parameters['include']);
            $includes= array_intersect($this->supported_includes,$include_params);

            $with_keys= array_keys($includes);

        }
        //return $this->filterProperties(Property::with($with_keys)->get(),$with_keys);
        return $this->filterProperties(Property::all(),$with_keys);
        
    }
    public function getProperty($prop_id){
        return $this->filterProperties(Property::where('id',$prop_id)->get(),['unit']);
    }
    protected function filterProperties($properties,$keys=[]){

        $data= [];
 
        foreach($properties as $property){

            $entry =[
                'property_name'=> $property->name,
                'property_location'=>$property->location,
                'property_caretaker'=>$property->caretaker_name,
                'property_description'=>$property->description,
                'property_no_units'=>$property->number_of_units,
                'href'=>url('api/v1/properties/'.$property->id),
            ];
            if(in_array('unit',$keys)){
                
                $units= Unit::where('in_property',$property->id)->get();
                $data2=[];
                foreach($units as $unit){
                    array_push($data2,$unit->unit_house_number);
                }


                $entry['units']=$data2;
                
            }
            
            $data[]= $entry;
        }
        return $data;

    }

}