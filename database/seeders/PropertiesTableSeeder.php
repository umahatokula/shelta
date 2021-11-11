<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        \DB::table('properties')->truncate();

        // factory(Property::class, 10)->create();
        \App\Models\Property::factory(200)->create();

        \Schema::enableForeignKeyConstraints();
    }
}
