<?php

namespace Database\Seeders;

use App\Models\Estate;
use Illuminate\Database\Seeder;

class EstatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estate::create([
            'name' => 'Life Camp Estate',
            'address' => 'Life Camp Abuja',
        ]);

        Estate::create([
            'name' => 'Otupko Estate',
            'address' => 'Otupko Abuja',
        ]);
    }
}
