<?php

namespace App\Http\Controllers;

use App\Exports\Properties;
use App\Exports\UnitsInPropertyExport;
use Maatwebsite\Excel\Excel;

use Illuminate\Http\Request;
use App\Property;
use App\Unit;
use App\UnitType;
use Session;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $properties= Property::all();
        return view('properties.index',['properties'=>$properties]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = validator(
            request()->only('p_name','p_location','no_units','caretaker_name','p_description'),
            ['p_name'=>'required',
              'p_location'=>'required',
             'no_units'=>'required',
             'caretaker_name'=>'required',
              'p_description'=>'required'
            ]
            );
            if ($validation->fails()) {   
                return redirect()->route('properties.create')
                ->withErrors($validation)
                ->withInput();
    
                }else{
                //store property
                $property= new Property;
                $property->name= $request->p_name;         
                $property->location= $request->p_location;
                $property->number_of_units= $request->no_units;
                $property->caretaker_name= $request->caretaker_name;
                $property->description= $request->p_description;

                $property->save();
               // Session::flash('success_property_save', 'Property Created Succesfully');
                return redirect()->route('properties.index');

                }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property= Property::findOrFail($id);
        $units= Unit::where('in_property', $id)->get();

        return view('properties.show',['property'=>$property,'units'=>$units]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $property= Property::find($id);
        return view('properties.edit',['property'=>$property]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validation = validator(
            request()->only('p_name','p_location','no_units','caretaker_name','p_description'),
            ['p_name'=>'required',
              'p_location'=>'required',
             'no_units'=>'required',
             'caretaker_name'=>'required',
              'p_description'=>'required'
            ]);
            
            if ($validation->fails()) {
                return redirect()->route('properties.index')
                ->withErrors($validation)
                ->withInput();

                
            }else{

                //find and update
                $property= Property::find($id);

                $property->name= $request->p_name;         
                $property->location= $request->p_location;
                $property->number_of_units= $request->no_units;
                $property->caretaker_name= $request->caretaker_name;
                $property->description= $request->p_description;
                
                $property->save();
                //Session::flash('success_property_update', 'Property Updated Succesfully');
                
                return redirect()->route('properties.index');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $findProperty= Property::find($id);
        $property_name = $findProperty->name;

        //dd($findProperty);
        if($findProperty->delete()){
            //delete all units in with prop_id
            $deleteunits= Unit::where('in_property', $id)->delete();
            

            return redirect()->route('properties.index')
                ->with('success', $property_name.' was Deleted');

        }else{
            return back()->withInput()->with('error',$property_name.' could not be Deleted' );
        }

    }
    public function addUnit($id)
    {
        $property= Property::find($id);
        $unit_types= UnitType::all(); 

        return view('units.create',['property'=>$property,'unit_types'=>$unit_types,'from'=>'properties']);
        
    }
    public function addTenant($id)
    {
        $property= Property::find($id);
        $units= Unit::where('in_property', $id)
                    ->where('occupancy', 'vacant')
                    ->get();
        return view('tenants.create',['property'=>$property,'units'=>$units,'from'=>'properties']);
        
    }
    public function printExcel(Excel $excel)
    {
        
        return $excel->download(new Properties,'tenantsaccounts.xlsx');
    }
    public function printUnits(Excel $excel,$id)
    {
       
        return $excel->download(new UnitsInPropertyExport($id),'unitsinproperty.xlsx');
    }
    
}
