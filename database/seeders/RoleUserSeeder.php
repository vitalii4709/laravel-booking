<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {

            DB::table('role_user')->insert([
                'user_id' => fake()->unique()->numberBetween(1, 10),
                'role_id' => fake()->randomElement($array = array (1,2,3))
            ]);
        }
    }
}
