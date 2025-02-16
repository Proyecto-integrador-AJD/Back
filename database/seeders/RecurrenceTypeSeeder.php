<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecurrenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recurrenceTypes = [
            ['name' => 'daily', 'spanishName' => 'diario', 'valencianName' => 'diari'],
            ['name' => 'weekly', 'spanishName' => 'semanal', 'valencianName' => 'setmanal'],
            ['name' => 'monthly', 'spanishName' => 'mensual', 'valencianName' => 'mensual'],
            ['name' => 'yearly', 'spanishName' => 'anual', 'valencianName' => 'anual'],
        ];

        foreach ($recurrenceTypes as $recurrenceType) {
            \App\Models\RecurrenceType::create($recurrenceType);
        }
    }
}
