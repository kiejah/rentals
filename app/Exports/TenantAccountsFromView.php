<?php

namespace App\Exports;

use App\TenantAccount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TenantAccountsFromView implements FromCollection, WithHeadings,ShouldAutoSize
{
    use Exportable;

    public function collection()
    {
        $tnt_accounts = TenantAccount::all(); 
        foreach ($tnt_accounts as $ta) {
            $data[]= array(
               'unit_house_number'=>$ta->unit->unit_house_number,
               'property_name'=>$ta->property->name,
               'tenant_name'=>$ta->tenant->firstname.' '.$ta->tenant->lastname.' '.$ta->tenant->surname,
               'unit_rent_charge'=>$ta->unit->rent_charge,
               'amount_payed'=>$ta->amt_payed,
               'for_month'=>date('F, Y', strtotime($ta->updated_at)),
               'payed_via'=>$ta->pymt_mode->name,
               'rcpt_mpesa_key'=>$ta->payment_mode_value,
               'balance_bf'=>$ta->balance_bf,
               'payment_made_by'=>$ta->payment_made_by,
           );
        }    
        
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Unit/House Number',
            'In Property',
            'Tenant Name',
            'Unit Rent Charge',
            'Amount Payed',
            'For the Month',
            'Payed Via',
            'Receipt No/Mpesa Code',
            'Balance',
            'Payments Made By',
        ];
    }
}
