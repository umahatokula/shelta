<?php

namespace App\Imports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PropertyImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Property([
            'estate_property_type_id ' => $row['estate_property_type_id'],
            'client_id '               => $row['client_id'],
            'unique_number'            => $row['unique_number'],
            'payment_plan_id'          => $row['payment_plan_id'],
            'date_of_first_payment'    => $row['date_of_first_payment'],
        ]);
    }
}
