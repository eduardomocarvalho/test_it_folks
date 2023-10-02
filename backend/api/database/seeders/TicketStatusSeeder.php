<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TicketStatus::updateOrCreate(['id' => 1], ['name' => 'New']);
        \App\Models\TicketStatus::updateOrCreate(['id' => 2], ['name' => 'Accepted']);
        \App\Models\TicketStatus::updateOrCreate(['id' => 3], ['name' => 'Closed']);
        \App\Models\TicketStatus::updateOrCreate(['id' => 4], ['name' => 'Cancel']);
    }
}
