<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SeriesTableSeeder::class);
        $this->call(MangasTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(PurchasesSeeder::class);

    }
}
