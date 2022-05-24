<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
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

        // payments
        $record_payment = Permission::create(['name' => 'record payment']);
        $online_payment = Permission::create(['name' => 'online payment']);

        // assign permissions to roles
        $staff->syncPermissions([$manage_clients, $manage_estates, $manage_property_types, $record_payment, $online_payment]);
        $client->syncPermissions([$online_payment]);


        // seed staff and user
        $staff = Staff::create([
            'name' => 'Umaha Tokula',
            'phone' => '08033312448',
            'email' => 'admin@shelta.tech',
            'gender_id' => 1,
        ]);

        $user = User::create([
            'name'     => $staff->name,
            'email'    => $staff->email,
            'staff_id' => $staff->id,
            'password' => Hash::make('12345678'),
        ]);

        // assign role
        $user->assignRole('staff');


    }
}
