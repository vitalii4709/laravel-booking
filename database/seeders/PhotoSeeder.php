<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {

            DB::table('photos')->insert([
                'photoable_type' => 'App\Models\TouristObject',
                'photoable_id' => fake()->numberBetween(1, 10),
                'path' => fake()->imageUrl(800, 400, 'city')
            ]);
        }

        for ($i = 1; $i <= 200; $i++) {

            DB::table('photos')->insert([
                'photoable_type' => 'App\Models\Room',
                'photoable_id' => fake()->numberBetween(1, 10),
                'path' => fake()->imageUrl(800, 400, 'nightlife')
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {

            DB::table('photos')->insert([
                'photoable_type' => 'App\Models\User',
                'photoable_id' => fake()->unique()->numberBetween(1, 10),
                'path' => fake()->imageUrl(275, 150, 'people')
            ]);
        }
    }
}
