<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            'Roman Catholic',
            'Protestant',
            'Evangelical / Born Again Christian',
            'Iglesia ni Cristo',
            'Aglipayan (Philippine Independent Church)',
            'Seventh-day Adventist',
            'Jehovah’s Witnesses',
            'Sunni Islam',
            'Shia Islam',
            'Buddhism',
            'Hinduism',
            'Sikhism',
            'Judaism',
            'Indigenous / Tribal Religion',
            'Animism',
            'None / No Religion',
            'Prefer not to say',
            'Others'
        ];

        foreach ($religions as $religion) {
            Religion::firstOrCreate([
                'religion_name' => $religion
            ]);
        }
        // php artisan db:seed --class=ReligionSeeder
    }
}
