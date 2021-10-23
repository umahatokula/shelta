<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles
        $staff = Role::create(['name' => 'staff']);
        $client = Role::create(['name' => 'client']);

        // permission
        $manage_clients = Permission::create(['name' => 'manage clients']);
        $manage_estates = Permission::create(['name' => 'manage estates']);
        $manage_property_types = Permission::create(['name' => 'manage property types']);

        // assign permissions to roles
        $staff->syncPermissions([$manage_clients, $manage_estates, $manage_property_types]);


    }
}
