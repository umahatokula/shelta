<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'sname'                 => $row['sname'],
            'onames'                => $row['onames'],
            'phone'                 => $row['phone'],
            'gender'                => $row['gender'],
            'dob'                   => $row['dob'],
            'email'                 => $row['email'],
            'city'                  => $row['city'],
            'state_id'              => $row['state_id'],
            'address'               => $row['address'],
            'nok_name'              => $row['nok_name'],
            'nok_address'           => $row['nok_address'],
            'nok_city'              => $row['nok_city'],
            'nok_state_id'          => $row['nok_state_id'],
            'relationship_with_nok' => $row['relationship_with_nok'],
            'employer_name'         => $row['employer_name'],
            'employer_address'      => $row['employer_address'],
            'employer_city'         => $row['employer_city'],
            'employer_state_id'     => $row['employer_state_id'],
            'employer_country_id'   => $row['employer_country_id'],
            'employer_phone'        => $row['employer_phone'],
        ]);
    }
}
