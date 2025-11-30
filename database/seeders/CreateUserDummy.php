<?php

namespace Database\Seeders;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
    {
        $faker = Factory::create('id_ID');

        foreach (range(1, 1000) as $index) {
            DB::table('users')->insert([
                'name'      => $faker->name(),      // nama orang Indonesia
                'email'     => $faker->unique()->safeEmail(),
                'password'  => Hash::make('password123'), // password default
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
