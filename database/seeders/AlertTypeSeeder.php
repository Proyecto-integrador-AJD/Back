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
                'name' => 'Aviso',
                'spanishName' => 'Aviso',
                'valencianName' => 'Aviso',
            ],
            [
                'name' => 'Seguiment segons protocols',
                'spanishName' => 'Seguimiento según protocolos',
                'valencianName' => 'Seguiment segons protocols',
            ],
            [
                'name' => 'Seguiment en aplicació segons protocols',
                'spanishName' => 'Seguimiento en aplicación según protocolos',
                'valencianName' => 'Seguiment en aplicació segons protocols',
            ],
            [
                'name' => 'Agendes d’absència domiciliària i retorn',
                'spanishName' => 'Agendas de ausencia domiciliaria y retorno',
                'valencianName' => 'Agendes d’absència domiciliària i retorn',
            ],
        ];

        foreach ($alertTypes as $alertType) {
            \App\Models\AlertType::create($alertType);
        }
    }
}
