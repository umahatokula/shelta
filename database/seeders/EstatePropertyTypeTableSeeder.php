<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstatePropertyType;

class EstatePropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        \DB::table('estate_property_type')->truncate();

        // factory(EstatePropertyType::class, 10)->create();
        \App\Models\EstatePropertyType::factory(6)->create();

        \Schema::enableForeignKeyConstraints();
    }
}
