<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        <?php

namespace App\Enums;

enum Language: string
{
    case SPANISH = 'Castellà';    // Español
    case CATALAN = 'Valencià';    // Valenciano (Catalán)
    case GALICIAN = 'Gallec';     // Gallego
    case BASQUE = 'Basco';        // Vasco
    case ENGLISH = 'Anglès';      // Inglés
    case FRENCH = 'Francès';      // Francés
    case GERMAN = 'Alemany';      // Alemán
    case ITALIAN = 'Italià';      // Italiano
    case PORTUGUESE = 'Portugués'; // Portugués
    case DUTCH = 'Neerlandès';    // Neerlandés
    case RUSSIAN = 'Rus';         // Ruso

    public static function getValues(): array
    {
        return [
            self::SPANISH,
            self::CATALAN,
            self::GALICIAN,
            self::BASQUE,
            self::ENGLISH,
            self::FRENCH,
            self::GERMAN,
            self::ITALIAN,
            self::PORTUGUESE,
            self::DUTCH,
            self::RUSSIAN,
        ];
    }
}

        */

        $prefixes = [
            ['spanishName' => 'castellano', 'name' => 'spanish', 'valencianName' => 'castellà'],
            ['spanishName' => 'valenciano', 'name' => 'catalan', 'valencianName' => 'valencià'],
            ['spanishName' => 'gallego', 'name' => 'galician', 'valencianName' => 'gallec'],
            ['spanishName' => 'vasco', 'name' => 'basque', 'valencianName' => 'basco'],
            ['spanishName' => 'inglés', 'name' => 'english', 'valencianName' => 'anglès'],
            ['spanishName' => 'francés', 'name' => 'french', 'valencianName' => 'francès'],
            ['spanishName' => 'alemán', 'name' => 'german', 'valencianName' => 'alemany'],
            ['spanishName' => 'italiano', 'name' => 'italian', 'valencianName' => 'italià'],
            ['spanishName' => 'portugués', 'name' => 'portuguese', 'valencianName' => 'portugués'],
            ['spanishName' => 'neerlandés', 'name' => 'dutch', 'valencianName' => 'neerlandès'],
            ['spanishName' => 'ruso', 'name' => 'russian', 'valencianName' => 'rus'],
        ];

        foreach ($prefixes as $prefix) {
            Language::create($prefix);
        }
    }
}
