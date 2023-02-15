<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        return [
            'content' => fake()->text(500),
            'rating' => fake()->numberBetween(1, 5),
            'user_id' => fake()->numberBetween(1, 10),
            'commentable_type' => fake()->randomElement($array = array('App\Models\TouristObject', 'App\Models\Article')),
            'commentable_id' => fake()->numberBetween(1, 10),
        ];
    }
}
