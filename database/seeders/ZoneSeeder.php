<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Enums\Spain\City;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            [
                'name' => 'Zona 1',
                'description' => 'Zona 1',
                'location' => City::MADRID,
            ],
            [
                'name' => 'Zona 2',
                'description' => 'Zona 2',
                'location' => City::BARCELONA,
            ],
            [
                'name' => 'Zona 3',
                'description' => 'Zona 3',
                'location' => City::VALENCIA,
            ],
            [
                'name' => 'Zona 4',
                'description' => 'Zona 4',
                'location' => City::SEVILLA,
            ],
            [
                'name' => 'Zona 5',
                'description' => 'Zona 5',
                'location' => City::ZARAGOZA,
            ],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }

        Zone::factory()->count(5)->create();
    }
}
