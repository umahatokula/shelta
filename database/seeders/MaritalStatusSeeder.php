<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaritalStatus::truncate();

        MaritalStatus::create([
            'name' => 'Single',
        ]);

        MaritalStatus::create([
            'name' => 'Married',
        ]);

        MaritalStatus::create([
            'name' => 'Divorced',
        ]);

        MaritalStatus::create([
            'name' => 'Seperated',
        ]);

        MaritalStatus::create([
            'name' => 'Other',
        ]);
    }
}
