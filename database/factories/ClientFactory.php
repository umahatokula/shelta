<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use PragmaRX\Countries\Package\Countries;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sname' => $this->faker->lastName(),
            'onames' => $this->faker->firstName(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->freeEmail(),
            'dob' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'gender' => rand(1, 2),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state_id' => rand(1, 36),
            'nok_name' => $this->faker->name(),
            'nok_address' => $this->faker->address(),
            'nok_city' => $this->faker->city(),
            'nok_state_id' => rand(1, 36),
            'relationship_with_nok' => 'sibling',
            'employer_name' => $this->faker->name(),
            'employer_address' => $this->faker->address(),
            'employer_city' => $this->faker->city(),
            'employer_state_id' => rand(1, 36),
            'employer_country_id' => 'NGA',
            'employer_phone' => $this->faker->e164PhoneNumber(),
            'payment_plan_id' => rand(1, 4),
            'agent_id' => rand(1, 10),
        ];
    }
}
