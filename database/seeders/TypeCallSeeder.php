<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeCalls = [ 
            [
                'name' => 'Emergency Attention',
                'spanishName' => 'Atención de emergencias',
                'valencianName' => 'Atenció d’emergències',
                'incoming' => true,
            ],
            [
                'name' => 'Non-Urgent Communications',
                'spanishName' => 'Comunicaciones no urgentes',
                'valencianName' => 'Comunicacions no urgents',
                'incoming' => true,
            ],
            [
                'name' => 'Planned or Scheduled',
                'spanishName' => 'Planificada o agendada',
                'valencianName' => 'Planificada o agendada',
                'incoming' => false,
            ],
            [
                'name' => 'Not Planned',
                'spanishName' => 'No planificadas',
                'valencianName' => 'No planificades',
                'incoming' => false,
            ],
        ];

        foreach ($typeCalls as $typeCall) {
            \App\Models\TypeCall::create($typeCall);
        }    
    }
}
