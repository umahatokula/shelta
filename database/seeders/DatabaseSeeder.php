<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\GenderTableSeeder;
use Database\Seeders\EstatesTableSeeder;
use Database\Seeders\PaymentPlansTableSeeder;
use Database\Seeders\PropertyGroupsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Client::factory(50)->create();
        // \App\Models\Property::factory(100)->create();
        // \App\Models\EstatePropertyType::factory(10)->create();
        \App\Models\Staff::factory(10)->create();

        $this->call([
            EstatesTableSeeder::class,
            PropertyTypesTableSeeder::class,
            RolesTableSeeder::class,
            StatesTableSeeder::class,
            LGAsTableSeeder::class,
            PaymentPlansTableSeeder::class,
            GenderTableSeeder::class,
        ]);
    }
}
