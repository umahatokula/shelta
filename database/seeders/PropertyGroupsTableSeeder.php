<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::create([
            'name' => '3 BEDROOM FLATS WITH 1 BQ',
            'description' => 'Serene environment ✔️
                Good roads ✔️
                Good Drainage ✔️
                24hrs power supply ✔️
                Street lights ✔️
                24hrs armed security ✔️
                You can be a part of the ochacho family with a N2.5m initial deposit, you can spread your balance and own your dream home with us.'
        ]);
        
        PropertyType::create([
            'name' => 'FULLY DETACHED DUPLEX WITH PENTHOUSE',
            'description' => 'Land size-600sqm
            40,000 per sqm-
            Price- 24 million
            5% discount on outright payment
            DPC-8 million
            Initial deposit 9.6 million
            Spread balance across six month
            Carcass-75 million
            Fully finished-95 million'
        ]);

        PropertyType::create([
            'name' => 'SEMI DETACHED DUPLEX WITH PENTHOUSE',
            'description' => 'Land size-350 sqm-
            40,000 per sqm-
            Price-14 million
            5% discount on outright payment
            DPC- 4 million
            Initial deposit- 4.8 million'
        ]);
    }
}
