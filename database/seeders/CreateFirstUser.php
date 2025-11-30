<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data['name']                  = "Gatot Kaca";
        $data['email']                 = "gatot@pcr.ac.id";
        $data['password']              = Hash::make("12345678");

        User::create($data);
    }
}
