<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EthnicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ethnicities')->insert([
            ['ethnicity_name' => 'Tagalog'],
            ['ethnicity_name' => 'Cebuano'],
            ['ethnicity_name' => 'Ilocano'],
            ['ethnicity_name' => 'Hiligaynon (Ilonggo)'],
            ['ethnicity_name' => 'Bicolano'],
            ['ethnicity_name' => 'Waray'],
            ['ethnicity_name' => 'Kapampangan'],
            ['ethnicity_name' => 'Pangasinense'],
            ['ethnicity_name' => 'Maranao'],
            ['ethnicity_name' => 'Maguindanao'],
            ['ethnicity_name' => 'Tausug'],
            ['ethnicity_name' => 'Yakan'],
            ['ethnicity_name' => 'Ivatan'],
            ['ethnicity_name' => 'Ifugao'],
            ['ethnicity_name' => 'Kalinga'],
            ['ethnicity_name' => 'Apayao (Isnag)'],
            ['ethnicity_name' => 'Tingguian (Itneg)'],
            ['ethnicity_name' => 'Aeta / Agta / Ati'],
            ['ethnicity_name' => 'Lumad'],
            ['ethnicity_name' => 'Badjao'],
            ['ethnicity_name' => 'Sama'],
            ['ethnicity_name' => 'Subanen'],
            ['ethnicity_name' => 'Manobo'],
            ['ethnicity_name' => 'T’boli'],
            ['ethnicity_name' => 'Blaan'],
            ['ethnicity_name' => 'Kalagan'],
            ['ethnicity_name' => 'Other'],
        ]);
        // php artisan db:seed --class=EthnicitySeeder
    }
}
