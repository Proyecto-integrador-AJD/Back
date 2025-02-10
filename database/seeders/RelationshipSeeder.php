<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Relationship;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relationships = [
            ['name' => 'FATHER', 'spanishName' => 'Padre', 'valencianName' => 'Pare'],
            ['name' => 'MOTHER', 'spanishName' => 'Madre', 'valencianName' => 'Mare'],
            ['name' => 'SON', 'spanishName' => 'Hijo', 'valencianName' => 'Fill'],
            ['name' => 'DAUGHTER', 'spanishName' => 'Hija', 'valencianName' => 'Filla'],
            ['name' => 'BROTHER', 'spanishName' => 'Hermano', 'valencianName' => 'Germà'],
            ['name' => 'SISTER', 'spanishName' => 'Hermana', 'valencianName' => 'Germana'],
            ['name' => 'GRANDFATHER', 'spanishName' => 'Abuelo', 'valencianName' => 'Avi'],
            ['name' => 'GRANDMOTHER', 'spanishName' => 'Abuela', 'valencianName' => 'Àvia'],
            ['name' => 'UNCLE', 'spanishName' => 'Tío', 'valencianName' => 'Oncle'],
            ['name' => 'AUNT', 'spanishName' => 'Tía', 'valencianName' => 'Tia'],
            ['name' => 'COUSIN', 'spanishName' => 'Primo', 'valencianName' => 'Cosí/Cosina'],
            ['name' => 'FRIEND', 'spanishName' => 'Amigo', 'valencianName' => 'Amic/Amiga'],
        ];

        foreach ($relationships as $relationship) {
            Relationship::create($relationship);
        }
    }
}
