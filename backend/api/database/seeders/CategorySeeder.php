<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::updateOrCreate(['id' => 1], ['name' => 'Technical support']);
        \App\Models\Category::updateOrCreate(['id' => 2], ['name' => 'Financial']);
        \App\Models\Category::updateOrCreate(['id' => 3], ['name' => 'Doubts']);
    }
}
