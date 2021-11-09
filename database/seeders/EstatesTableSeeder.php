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
        if (env('PHILEOTECH_CLIENT') == 'hall7') {
            Estate::create([
                'name' => 'Imperial Vista',
                'address' => 'Abuja',
            ]);
    
            Estate::create([
                'name' => 'The Bridge',
                'address' => 'Abuja',
            ]);
    
            Estate::create([
                'name' => 'Cubiq Residence',
                'address' => 'Abuja',
            ]);
    
            Estate::create([
                'name' => 'Brookshore Residence',
                'address' => 'Abuja',
            ]);
        }

        if (env('PHILEOTECH_CLIENT') == 'ochacho') {
            Estate::create([
                'name' => 'LifeCamp',
                'address' => 'Abuja',
            ]);
    
            Estate::create([
                'name' => 'Karimo',
                'address' => 'Abuja',
            ]);
    
            Estate::create([
                'name' => 'Apo',
                'address' => 'Abuja',
            ]);
    
        }
        
    }
}
