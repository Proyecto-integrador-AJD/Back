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
