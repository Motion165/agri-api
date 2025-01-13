<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Farmer;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Farmer::factory()
        ->count(25)
        ->hasTransactions(10)
        ->create();

        Farmer::factory()
        ->count(100)
        ->hasTransactions(5)
        ->create();

        Farmer::factory()
        ->count(100)
        ->hasTransactions(3)
        ->create();

        Farmer::factory()
        ->count(5)
        ->create();
    }
}
