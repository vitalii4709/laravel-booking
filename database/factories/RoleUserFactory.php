<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Console\Factories\WithoutModelEvents;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $table = 'role_user';
    
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique(true)->numberBetween(1, 3),
            'role_id' => $this->faker->randomElement($array = array (1,2,3))
        ];
    }

}
