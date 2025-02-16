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
            ['name' => 'father', 'spanishName' => 'padre', 'valencianName' => 'pare'],
            ['name' => 'mother', 'spanishName' => 'madre', 'valencianName' => 'mare'],
            ['name' => 'son', 'spanishName' => 'hijo', 'valencianName' => 'fill'],
            ['name' => 'daughter', 'spanishName' => 'hija', 'valencianName' => 'filla'],
            ['name' => 'brother', 'spanishName' => 'hermano', 'valencianName' => 'germà'],
            ['name' => 'sister', 'spanishName' => 'hermana', 'valencianName' => 'germana'],
            ['name' => 'grandfather', 'spanishName' => 'abuelo', 'valencianName' => 'avi'],
            ['name' => 'grandmother', 'spanishName' => 'abuela', 'valencianName' => 'àvia'],
            ['name' => 'uncle', 'spanishName' => 'tío', 'valencianName' => 'oncle'],
            ['name' => 'aunt', 'spanishName' => 'tía', 'valencianName' => 'tia'],
            ['name' => 'cousin', 'spanishName' => 'primo', 'valencianName' => 'cosí/cosina'],
            ['name' => 'friend', 'spanishName' => 'amigo', 'valencianName' => 'amic/amiga'],
        ];

        foreach ($relationships as $relationship) {
            Relationship::create($relationship);
        }
    }
}
