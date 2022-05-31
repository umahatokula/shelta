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
        // ===================ROLES=================
        $ceo = Role::create(['name' => 'ceo']);
        $general_manager = Role::create(['name' => 'general_manager']);
        $accountant = Role::create(['name' => 'accountant']);
        $legal = Role::create(['name' => 'legal']);
        $customer_care = Role::create(['name' => 'customer_care']);

        $client = Role::create(['name' => 'client']);

        // =====================PERMISSION========================
        // clients
        $create_client = Permission::create(['name' => 'create client']);
        $edit_client = Permission::create(['name' => 'edit client']);
        $view_client = Permission::create(['name' => 'view client']);
        $delete_client = Permission::create(['name' => 'delete client']);
        $send_client_notification = Permission::create(['name' => 'send client notification']);


        // staff
        $create_staff = Permission::create(['name' => 'create staff']);
        $edit_staff = Permission::create(['name' => 'edit staff']);
        $view_staff = Permission::create(['name' => 'view staff']);
        $delete_staff = Permission::create(['name' => 'delete staff']);


        // property prices
        $create_property_price = Permission::create(['name' => 'create property price']);
        $edit_property_price = Permission::create(['name' => 'edit property price']);
        $view_property_prices = Permission::create(['name' => 'view property prices']);
        $delete_property_price = Permission::create(['name' => 'delete property price']);


        // payment plans
        $create_payment_plan = Permission::create(['name' => 'create payment plan']);
        $edit_payment_plan = Permission::create(['name' => 'edit payment plan']);
        $view_payment_plans = Permission::create(['name' => 'view payment plans']);
        $delete_payment_plan = Permission::create(['name' => 'delete payment plan']);


        // property type
        $create_property_type = Permission::create(['name' => 'create property type']);
        $edit_property_type = Permission::create(['name' => 'edit property type']);
        $view_property_types = Permission::create(['name' => 'view property types']);
        $delete_property_type = Permission::create(['name' => 'delete property type']);


        // estate
        $create_estate = Permission::create(['name' => 'create estate']);
        $edit_estate = Permission::create(['name' => 'edit estate']);
        $view_estates = Permission::create(['name' => 'view estates']);
        $delete_estate = Permission::create(['name' => 'delete estate']);


        // property
        $create_property = Permission::create(['name' => 'create property']);
        $edit_property = Permission::create(['name' => 'edit property']);
        $view_property = Permission::create(['name' => 'view property']);
        $delete_property = Permission::create(['name' => 'delete property']);
        $assign_property = Permission::create(['name' => 'assign property']);


        // transaction
        $view_transactions = Permission::create(['name' => 'view transactions']);
        $view_transaction_total = Permission::create(['name' => 'view transaction total']);
        $process_transactions = Permission::create(['name' => 'process transactions']);


        // settings
        $set_payment_reminders = Permission::create(['name' => 'set payment reminders']);
        $set_company_profile = Permission::create(['name' => 'set company profile']);
        $imports = Permission::create(['name' => 'imports']);


        // payments
        $view_completed_payments = Permission::create(['name' => 'view completed payments']);
        $view_payment_list = Permission::create(['name' => 'view payment list']);
        $view_defaulters_list = Permission::create(['name' => 'view defaulters list']);
        $record_payment = Permission::create(['name' => 'record payment']);
        $online_payment = Permission::create(['name' => 'online payment']);
        $view_client_own_payments = Permission::create(['name' => 'view client own payments']);


        // others
        $generate_land_papers = Permission::create(['name' => 'generate land papers']);



        //=====================ATTACH ROLES====================================
        $ceo->syncPermissions([
            $create_client, $edit_client, $view_client, $delete_client, $send_client_notification,
            $create_staff, $edit_staff, $view_staff, $delete_staff,
            $create_property_price, $edit_property_price, $view_property_prices, $delete_property_price,
            $create_payment_plan, $edit_payment_plan, $view_payment_plans, $delete_payment_plan,
            $create_property_type, $edit_property_type, $view_property_types, $delete_property_type,
            $create_estate, $edit_estate, $view_estates, $delete_estate,
            $create_property, $edit_property, $view_property, $delete_property, $assign_property,
            $view_transactions, $view_transaction_total, $process_transactions,
            $set_payment_reminders, $set_company_profile, $imports,
            $view_completed_payments, $view_payment_list, $view_defaulters_list, $record_payment, $online_payment,
        ]);

        $general_manager->syncPermissions([
            $create_client, $edit_client, $view_client, $delete_client,
            $create_staff, $edit_staff, $view_staff, $delete_staff,
            $create_property_price, $edit_property_price, $view_property_prices, $delete_property_price,
            $create_payment_plan, $edit_payment_plan, $view_payment_plans, $delete_payment_plan,
            $create_property_type, $edit_property_type, $view_property_types, $delete_property_type,
            $create_estate, $edit_estate, $view_estates, $delete_estate,
            $create_property, $edit_property, $view_property, $delete_property, $assign_property,
            $view_transactions, $view_transaction_total, $process_transactions,
            $set_payment_reminders, $set_company_profile, $imports,
            $view_completed_payments, $view_payment_list, $view_defaulters_list, $record_payment, $online_payment,
        ]);

        $accountant->syncPermissions([
            $send_client_notification,
            $view_property_prices,
            $edit_payment_plan, $view_payment_plans,
            $set_payment_reminders,
            $view_completed_payments,
            $view_payment_list,
            $view_defaulters_list,
        ]);

        $client->syncPermissions([
            $create_client, $view_client, $edit_client,
            $view_property_prices,
            $view_payment_plans,
            $view_property_types,
            $view_estates,
            $view_property,
        ]);

        $legal->syncPermissions([
            $create_staff,
            $edit_staff, $view_staff,
            $delete_staff,
            $edit_property,
            $view_property,
            $set_company_profile,
            $imports,
            $generate_land_papers,
        ]);

        $customer_care->syncPermissions([
            $send_client_notification
        ]);


        $client->syncPermissions([
            $record_payment,
            $online_payment,
            $view_client_own_payments,
        ]);



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
        $user->assignRole('ceo');


    }
}
