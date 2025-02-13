<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alertTypes = [
            [
                'name' => 'Notice',
                'spanishName' => 'Aviso',
                'valencianName' => 'Aviso',
            ],
            [
                'name' => 'Follow-up according to protocols',
                'spanishName' => 'Seguimiento según protocolos',
                'valencianName' => 'Seguiment segons protocols',
            ],
            [
                'name' => 'Follow-up in application according to protocols',
                'spanishName' => 'Seguimiento en aplicación según protocolos',
                'valencianName' => 'Seguiment en aplicació segons protocols',
            ],
            [
                'name' => 'Home absence and return agendas',
                'spanishName' => 'Agendas de ausencia domiciliaria y retorno',
                'valencianName' => 'Agendes d’absència domiciliària i retorn',
            ],
            
        ];

        foreach ($alertTypes as $alertType) {
            \App\Models\AlertType::create($alertType);
        }
    }
}
