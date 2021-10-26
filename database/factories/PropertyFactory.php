<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'estate_property_type_id' => rand(1, 10),
            'client_id' => rand(1, 50),
            'unique_number' => $this->faker->unique()->ean8,
            'payment_plan_id' => rand(1, 4),
        ];
    }
}
