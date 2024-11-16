<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([
            [
                'id' => 1,
                'user_fk' => 2,
                'total_price' => 2100,
                'purchase_date' => '2022-12-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_fk' => 2,
                'total_price' => 1000,
                'purchase_date' => '2022-12-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'user_fk' => 3,
                'total_price' => 1150,
                'purchase_date' => '2022-12-11',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('purchases_has_mangas')->insert([
            [
                'purchase_fk' => 1,
                'manga_fk' => 1,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_fk' => 1,
                'manga_fk' => 2,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_fk' => 2,
                'manga_fk' => 5,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_fk' => 3,
                'manga_fk' => 13,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }   
}
