<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\Property;
use App\Tenant;
use Session;


class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $properties;
    private $units;


    public function __construct()
    {
        $this->properties= Property::all();
        // all vacant units
        $this->units= Unit::where('occupancy','Vacant')->get(); 
    }


    public function index()
    {
        //
        $tenants= Tenant::all();
        return view('tenants.index',['tenants'=>$tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tenants.create',['properties'=>$this->properties,'units'=>$this->units,'from'=>'tenants']);
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
            request()->only('firstname','lastname','surname','email','phonenumber','next_of_kin_name','next_of_kin_phone','in_property_id','in_unit_id'),
            [
                'firstname'=>'required',
                'lastname'=>'required',
                'surname'=>'required',
                'email'=>'required',
                'phonenumber'=>'required',
                'next_of_kin_name'=>'required',
                'next_of_kin_phone'=>'required',
                'in_property_id'=>'required',
                'in_unit_id'=>'required'
            ]
            );
            if ($validation->passes()) {   
                //store property
                $tenant= new Tenant;
                $tenant->firstname= $request->firstname;         
                $tenant->lastname= $request->lastname;
                $tenant->surname= $request->surname;
                $tenant->email= $request->email;
                $tenant->phonenumber= $request->phonenumber;
                $tenant->next_of_kin_name= $request->next_of_kin_name;
                $tenant->next_of_kin_phone= $request->next_of_kin_phone;
                $tenant->in_property_id= $request->in_property_id;
                $tenant->in_unit_id= $request->in_unit_id;
                //dd($tenant);
                $tenant->save();
                Session::flash('success_tenant_save', 'Tenant Created Succesfully');
                //change occupancy state of unit
                $unit = Unit::find($request->in_unit_id);
                if($unit) {
                    $unit->occupancy = 'Occupied';
                    $unit->tenant_id = $tenant->id;
                    $unit->save();
                }

                //redirect to all tenants
                return redirect()->route('tenants.index');
    
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
        //
        $tenant= Tenant::find($id);
        return view(
            'tenants.show',['unit'=>$tenant]
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
        //
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
}
