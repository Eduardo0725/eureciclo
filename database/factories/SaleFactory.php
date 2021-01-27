<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'buyer' => $this->faker->name,
            'description' => $this->faker->sentence,
            'price_unit' => $this->faker->randomFloat(2, 2.99, 50),
            'lot' => $this->faker->randomNumber(2),
            'address' => $this->faker->address,
            'vendor' => $this->faker->company
        ];
    }
}
