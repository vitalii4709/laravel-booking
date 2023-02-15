<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Reservation::class;


    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'city_id' => fake()->numberBetween(1, 10),
            'room_id' => fake()->numberBetween(1, 30),
            'status' => fake()->boolean(50),
            'day_in' => fake()->dateTimeBetween('-10 days','now'),
            'day_out' => fake()->dateTimeBetween('now', '+10 days'),
        ];
    }
}
