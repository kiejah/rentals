<?php

namespace App\Http\Controllers;

use App\Exports\TenantAccountsFromView;
use Maatwebsite\Excel\Excel;

use App\TenantAccount;
use Illuminate\Http\Request;
use App\Unit;
use App\Property;
use App\Tenant;
use App\PaymentMode;
use App\TransRecord;
use App\AriasnBalance;

class TenantAccountsController extends Controller
{
    private $properties;
    private $units;
    private $payment_modes;


    public function __construct()
    {
        $this->properties= Property::all();
        $this->units= Unit::all(); 
        $this->payment_modes= PaymentMode::all();
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tnt_accounts = TenantAccount::all();

     return view('accounts.index', compact('tnt_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $request = new Request();
        return view('accounts.create',['properties'=>$this->properties,
                                        'units'=>$this->units,
                                        'payment_modes'=>$this->payment_modes,
                                        'request'=>$request
                                        ]);
    }
    public function unitDetails($unit_id, $prop_id){
        $details= TenantAccount::where('for_house_no',$unit_id)->where('in_prop',$prop_id)->first();
        return $details;
    }
    public function mainUnitDetails($unit_id, $prop_id){
        $maindetails= Unit::where('id',$unit_id)->where('in_property',$prop_id)->first();
        return $maindetails;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        //dd($request);

        $validation = validator(
            request()->only('monthly_rent','amt_payable','amt_payed','payment_mode','date_payed'),
            ['monthly_rent'=>'required',
              'amt_payable'=>'required',
             'amt_payed'=>'required',
             'payment_mode'=>'required',
              'date_payed'=>'required'
            ]
            );
            if ($validation->passes()) {   
                //check if there is prev balance in unit
                $unitdetails = $this->unitDetails($request->in_unit_id,$request->in_property_id);
               

                if($unitdetails){//edit curr record
                    $this->saveInTenantsAccounts($request,$unitdetails->id); 
                }else{//save afresh
                    $this->saveInTenantsAccounts($request,null);
                }
                //save in arias and balances account  || Update 
                $ariasnbal = new AriasnBalance();
                
                $ariasnbal->date= $request->date_payed;
                $ariasnbal->month= $request->date_payed;
                $ariasnbal->amount_payed= $request->amt_payed;
                //check if the amount payed is mre than amount payable
                if((intval($request->amt_payed)-intval($request->amt_payable)) > 0){
                    $ariasnbal->arias_amount= 0;
                    $ariasnbal->extra_amount= intval($request->amt_payed)-intval($request->amt_payable);   

                }elseif((intval($request->amt_payed)-intval($request->amt_payable)) < 0){
                    $ariasnbal->arias_amount= intval($request->amt_payable)-intval($request->amt_payed);
                    $ariasnbal->extra_amount= 0;  
                }else{
                    $ariasnbal->arias_amount= 0;
                    $ariasnbal->extra_amount= 0; 
                }
                $ariasnbal->house_id= $request->in_unit_id; 
                //TODO: a way to teck in tents trans history
                $ariasnbal->tenant_accounts_id= 0; 

                $ariasnbal->save(); 

                //save in tenant transaction history
                $trans_record= new TransRecord();
                $trans_record->payed_by= $request->payment_made_by;
                $trans_record->amt_payed= intval($request->amt_payed);
                $trans_record->balance= intval($request->amt_payable)-intval($request->amt_payed);
                $trans_record->house_id= $request->in_unit_id;
                $trans_record->date_payed= $request->date_payed;
                $trans_record->payment_mode= $request->payment_mode;
                $trans_record->payment_mode_value= $request->payment_mode_value;
                $trans_record->save(); 

                dd($trans_record);

                Session::flash('success_payment_save', 'Payment Transaction Created Succesfully');
                return redirect()->route('properties.index');
    
                }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TenantAccount  $tenantAccount
     * @return \Illuminate\Http\Response
     */
    public function show(TenantAccount $tenantAccount)
    {
        //
        dd($tenantAccount);
    }
    private function saveInTenantsAccounts(Request $request,$id=null)
    {
                if($id){
                    $curr_details= TenantAccount::where('id',$id)->first();
                    $transaction= TenantAccount::find($id); 
                    $acctdetails=unitDetails($request->in_unit_id, $request->in_property_id);

                    $transaction->monthly_rent= $request->monthly_rent;
                    //extra arias to carry forward
                    
                    $transaction->balance_bf= (intval($curr_details->balance_bf)) + (intval($request->amt_payable)-intval($request->amt_payed));
                    
                    $transaction->amt_payable= intval($curr_details->monthly_rent)+intval($curr_details->balance_bf);
                    $transaction->amt_payed= $request->amt_payed;
                    //extra Amt to carry forward
                    $transaction->balance_cf= ($transaction->amt_payed)-($transaction->amt_payable);                   
                    $transaction->date_payed= $request->date_payed;
                    $transaction->in_prop= $request->in_property_id;
                    $transaction->for_house_no= $request->in_unit_id;
                    $transaction->payment_made_by= $request->payment_made_by;
                    $transaction->contact_tel= $request->payment_made_by_phonenumber;
                    $transaction->payment_mode= $request->payment_mode;
                    $transaction->payment_mode_value =$request->payment_mode_value;

                    $transaction->save();
                 }else{
                    $transaction= new TenantAccount();
                    $transaction->monthly_rent= $request->monthly_rent;
                    
                    $transaction->balance_bf= intval($request->amt_payable)-intval($request->amt_payed);
                    $transaction->amt_payable= $request->amt_payable;
                    $transaction->amt_payed= $request->amt_payed;
                    //extra Amt to carry forward
                    $transaction->balance_cf= intval($request->amt_payed)-intval($request->amt_payable);                   
                    $transaction->date_payed= $request->date_payed;
                    $transaction->in_prop= $request->in_property_id;
                    $transaction->for_house_no= $request->in_unit_id;
                    $transaction->payment_made_by= $request->payment_made_by;
                    $transaction->contact_tel= $request->payment_made_by_phonenumber;
                    $transaction->payment_mode= $request->payment_mode;
                    $transaction->payment_mode_value =$request->payment_mode_value;

                    $transaction->save();

                 }


                
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TenantAccount  $tenantAccount
     * @return \Illuminate\Http\Response
     */
    //public function edit(TenantAccount $tenantAccount)
    public function edit($id)
    {
        //
        $acc = TenantAccount::findOrFail($id);
        dd($acc);
        return view('accounts.edit', compact('acc'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TenantAccount  $tenantAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'monthly_rent' => 'required|numeric',
            'balance_bf' => 'required|numeric',
            'amt_payable' => 'required|numeric',
            'amt_payed' => 'required|numeric',
            'balance_cf' => 'required|numeric',
            'payment_mode_value' => 'required|max:25',
            'date_payed' => 'required|max:25',
            'in_prop' => 'required|max:11',
            'for_house_no' => 'required|max:11',
            'payment_made_by' => 'required|max:55',
            'contact_tel' => 'required|max:25',
            'payment_mode' => 'required|max:1',
            'lead_actor' => 'required|max:255',
        ]);
        TenantAccount::whereId($id)->update($validatedData);

        return redirect('/accounts')->with('success', 'Show is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TenantAccount  $tenantAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(TenantAccount $tenantAccount)
    {
        //
    }
    public function printExcel(Excel $excel)
    {
        
        return $excel->download(new TenantAccountsFromView, 'tenantsaccounts.xlsx');
    }

}
