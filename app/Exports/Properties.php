<?php

namespace App\Exports;

use App\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Properties implements FromCollection, WithHeadings,ShouldAutoSize
{
    use Exportable;

    public function collection()
    {
        $properties = Property::all(); 
        foreach ($properties as $prop) {
            $data[]= array(
               'prop_name'=>$prop->name,
               'prop_loc'=>$prop->location,
               'number_of_units'=>$prop->number_of_units,
               'caretaker_name'=>$prop->caretaker_name,
               'desc'=>$prop->description,
           );
        }    
        
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Property Name',
            'Property Location',
            'Number of Units',
            'Caretaker`s Name',
            'Description',
        ];
    }
}
