<?php

namespace Database\Factories;

use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstatePropertyTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EstatePropertyType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'estate_id' => rand(1, 2),
            'property_type_id' => rand(1, 3),
            'price' => 80000000,
            'number_of_units' => rand(15, 35),
        ];
    }
}
