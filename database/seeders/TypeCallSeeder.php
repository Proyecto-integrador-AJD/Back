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
            ]
        ];

        foreach ($typeCalls as $typeCall) {
            \App\Models\TypeCall::create($typeCall);
        }    
    }
}
