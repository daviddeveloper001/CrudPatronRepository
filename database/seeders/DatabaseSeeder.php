<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Ticket;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();

        Car::factory(50)->create();
        Ticket::factory(50)->create();
    }
}
