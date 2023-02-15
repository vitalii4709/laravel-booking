<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TouristObject>
 */
class TouristObjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        $name = fake()->unique()->name() . ' ' . 'Hotel';
        return [
            'name' => $name,
            'user_id' => fake()->numberBetween(1,10),
            'city_id' => fake()->numberBetween(1,10),
            'description' => fake()->text(1000),
        ];
    }
}
