<?php

namespace Database\Seeders;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User; // Ditambahkan: Walaupun menggunakan DB::table, ini adalah praktik baik.

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        // Menambahkan satu akun SuperAdmin yang spesifik
        DB::table('users')->insert([
            'name'       => 'Admin Super',
            'email'      => 'admin@pop.test',
            'password'   => Hash::make('admin123'), // Ganti dengan password yang kuat
            'role'       => 'SuperAdmin', // Akun khusus Super Admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Loop untuk membuat 1000 data dummy
        foreach (range(1, 1000) as $index) {
            DB::table('users')->insert([
                'name'       => $faker->name(),      // nama orang Indonesia
                'email'      => $faker->unique()->safeEmail(),
                'password'   => Hash::make('password123'), // password default
                'role'       => 'Pelanggan', // <-- Wajib diisi untuk mengatasi error
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
