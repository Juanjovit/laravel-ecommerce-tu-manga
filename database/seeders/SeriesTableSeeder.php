<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('series')->insert([
            [
                'id' => 1,
                'title' => 'Boku no Hero Academia',
                'image' => 'myHeroAcademiaSerie.jpg',
                'image_description' => "Tapa de los mangas de My Hero Academia",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Gotoubun no Hanayome',
                'image' => 'somosQuintillizasSerie.jpg',
                'image_description' => "Tapa de los mangas de Gotoubun no Hanayome",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Great Teacher Onizuka | GTO',
                'image' => 'gtoSerie.jpg',
                'image_description' => "Tapa de los mangas de Great Teacher Onizuka",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'title' => 'Spy x Family',
                'image' => 'spyxfamilySerie.jpg',
                'image_description' => "Tapa de los mangas de Spy x Family",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
