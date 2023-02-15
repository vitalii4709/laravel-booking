<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 40; $i++) {
            DB::table('likeables')->insert([
                'likeable_type' => fake()->randomElement($array = array('App\Models\TouristObject', 'App\Models\Article')),
                'likeable_id' => fake()->numberBetween(1, 10),
                'user_id' => fake()->numberBetween(1, 10),
            ]);
        }
    }
}
