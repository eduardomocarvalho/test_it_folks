<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(['id' => 1, 'cpf' => '02787307108', 'name' => 'edu', 'email' => 'edu@gmail.com', 'password' => bcrypt('edu123')]);
    }
}
