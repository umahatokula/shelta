<?php

namespace Database\Seeders;

use App\Models\PaymentPlan;
use Illuminate\Database\Seeder;

class PaymentPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PaymentPlan::create([
            'name' => 'Full Payment',
            'number_of_months' => 1,
        ]);

        PaymentPlan::create([
            'name' => '1 year payment (12 months)',
            'number_of_months' => 12,
        ]);

//        PaymentPlan::create([
//            'name' => '1 and half year payment (18 months)',
//            'number_of_months' => 18,
//        ]);
//
//        PaymentPlan::create([
//            'name' => '2 years payment (24 months)',
//            'number_of_months' => 24,
//        ]);
    }
}
