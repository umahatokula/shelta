<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id'          => rand(1, 3),
            'property_id'        => rand(1, 3),
            'amount'             => 15000,
            'type'               => 'online',
            'transaction_number' => time(),
            'date'               => Carbon::now(),
            'instalment_date'    => Carbon::now()->addDays(30),
            'recorded_by'        => 1,
            'status'             => 1,
            'is_approved'        => 1,
        ];
    }
}
