<?php

namespace App\Enums\Spain;

enum Province: string
{
    case BARCELONA = 'Barcelona';
    case MADRID = 'Madrid';
    case VALENCIA = 'Valencia';
    case SEVILLA = 'Sevilla';
    case ZARAGOZA = 'Zaragoza';
    case MALAGA = 'Málaga';
    case MURCIA = 'Murcia';
    case BALEARES = 'Islas Baleares';
    case LAS_PALMAS = 'Las Palmas';
    case ALICANTE = 'Alicante';
    case CORDOBA = 'Córdoba';
    case GRANADA = 'Granada';
    case TOLEDO = 'Toledo';
    case TENERIFE = 'Santa Cruz de Tenerife';
    case BIZKAIA = 'Bizkaia';
    case A_CORUNA = 'A Coruña';
    case ASTURIAS = 'Asturias';
    case CANTABRIA = 'Cantabria';
    case OURENSE = 'Ourense';
    case NAVARRA = 'Navarra';

    public function postalPrefix(): string
    {
        return match ($this) {
            self::BARCELONA => '08',
            self::MADRID => '28',
            self::VALENCIA => '46',
            self::SEVILLA => '41',
            self::ZARAGOZA => '50',
            self::MALAGA => '29',
            self::MURCIA => '30',
            self::BALEARES => '07',
            self::LAS_PALMAS => '35',
            self::ALICANTE => '03',
            self::CORDOBA => '14',
            self::GRANADA => '18',
            self::TOLEDO => '45',
            self::TENERIFE => '38',
            self::BIZKAIA => '48',
            self::A_CORUNA => '15',
            self::ASTURIAS => '33',
            self::CANTABRIA => '39',
            self::OURENSE => '32',
            self::NAVARRA => '31',
        };
    }
}
