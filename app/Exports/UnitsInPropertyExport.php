<?php

namespace App\Exports;

use App\Property;
use App\Unit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UnitsInPropertyExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    use Exportable;
    private $id;
    public function __construct($id)
    {
        $this->id= $id;        
    }

    public function collection()
    {
        $units= Unit::where('in_property', $this->id)->get();

        foreach ($units as $unit) {
            $data[]= array(
               'unit_no'=>$unit->unit_house_number,
               'unit_type'=>$unit->unitType->unit_type_name,
               'standard'=>$unit->unitType->standard,
               'rent'=>$unit->rent_charge,
               'occupancy'=>$unit->occupancy,
           );
        }    
        
        return collect($data);
    }

    public function headings(): array
    {
        $property= Property::find($this->id);
        return [
            [' ',' ','Property Name:'.$property->name,$property->location],
            [' '],
            ['Unit/House No','Unit Type','Unit Standard','Rent Amount','Occupancy']
        ];
    }
}
