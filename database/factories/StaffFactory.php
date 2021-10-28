<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->lastName(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->freeEmail(),
            'dob' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'gender_id' => rand(1, 2),
        ];
    }
}
