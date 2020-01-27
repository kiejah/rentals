<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Property;
use App\Tenant;
use App\UnitType;
use App\TenantAccount;
use Session;


class UnitsController extends Controller
{
    private $properties;
    private $unit_types;
    private $tenants;

    public function __construct()
    {
        $this->properties= Property::all();
        $this->unit_types= UnitType::all();
        $this->tenants= Tenant::all(); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $units= Unit::all();
        return view('units.index',['units'=>$units]);
    }
    public function showVacant()
    {
        //
        $units= Unit::where('occupancy','Vacant')->get();
        return view('units.index',['units'=>$units]);
    }
    public function showOccupied()
    {
        //
        $units= Unit::where('occupancy','Occupied')->get();
        return view('units.index',['units'=>$units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('units.create',['properties'=>$this->properties,'unit_types'=>$this->unit_types,'from'=>'units']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if max number of units is reached
        $units= Unit::where('in_property',$request->in_property)->get();
        $prop = Property::where('id',$request->in_property)->first();
        $no_units_in_prop= $prop->number_of_units;

        $mssg='';
       

        $validation = validator(
            request()->only('in_property','unit_house_number','unit_type','rent_charge'),
            ['in_property'=>'required',
              'unit_house_number'=>'required',
             'unit_type'=>'required',
             'rent_charge'=>'required'
            ]
            );

           
            if ($validation->passes()) {   

                if(sizeof($units) < $no_units_in_prop){
                //store unit
                $unit= new Unit;
                $unit->unit_house_number= $request->unit_house_number;         
                $unit->in_property= $request->in_property;
                $unit->unit_type= $request->unit_type;
                $unit->rent_charge= $request->rent_charge;

                $unit->save();
                $mssg.='Unit added In Property '.$prop->name;
                }else{
                    $mssg.='No More Units can be added In Property'.$prop->name;
                }

                Session::flash('success_unit_save', 'Unit Created Succesfully');
                return redirect()->route('units.index',['message'=>$mssg]);
    
                }
    }
    public function addTenant($id)
    {
        $unit= Unit::find($id);
        $property= Property::find($unit->in_property);

        return view('tenants.create',['property'=>$property,'unit'=>$unit,'from'=>'unit']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit= Unit::find($id);
        return view('units.show',['unit'=>$unit,
        'properties'=>$this->properties,
        'unit_types'=>$this->unit_types,
        'tenants'=>$this->tenants]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit= Unit::find($id);
        return view('units.edit',['unit'=>$unit,
                                'properties'=>$this->properties,
                                'unit_types'=>$this->unit_types,
                                'tenants'=>$this->tenants]
                    );

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
            request()->only('in_property','unit_house_number','unit_type','rent_charge','occupancy','tenant_id'),
            ['in_property'=>'required',
              'unit_house_number'=>'required',
             'unit_type'=>'required',
             'rent_charge'=>'required',
              'occupancy'=>'required',
              'tenant_id'=>'required'
            ]);
            
            if ($validation->passes()) {
               
                //find and update
                $unit= Unit::find($id);

                $unit->in_property= $request->in_property;         
                $unit->unit_house_number= $request->unit_house_number;
                $unit->unit_type= $request->unit_type;
                $unit->rent_charge= $request->rent_charge;
                $unit->occupancy= $request->occupancy;
                $unit->tenant_id= $request->tenant_id;
                
                $unit->save();
                Session::flash('success_unit_update', 'Unit/House Updated Succesfully');
                
                return redirect()->route('units.index');
                
                
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
    }
    public function propertyUnits(Request $request){

        $units= Unit::where('in_property',$request->property_id)
                    ->where('occupancy', 'vacant')
                    ->get();
        $output= '<select class="form-control" name="in_unit_id" id="in_unit_id" class="form-control @error(\'in_unit_id\') is-invalid @enderror" onChange="getRentAmmount()"><option value="xxx">--Select House</option>';

        foreach ($units as $unit ){
            $data[]='<option value="'.$unit->id.'">'.$unit->unit_house_number.'</option>';
        }
        $output.= implode('',$data);
       $output.='</select>';

       //echo $output;
    
    return response()->json($output, 200);

    }
    public function unitRent(Request $request){
        
        $unit= Unit::find($request->id); 
        $curr_details= TenantAccount::where('for_house_no',$request->id)->first(); 
        if(isset($curr_details) && !empty($curr_details)) {
            return response()->json(array('rent_charge'=>$curr_details->monthly_rent,'balance_bf'=>$curr_details->balance_bf), 200);
        }else{
            return response()->json(array('rent_charge'=>$unit->rent_charge,'balance_bf'=>'0'), 200);
        } 
        

    }
}
