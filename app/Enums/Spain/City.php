<?php

namespace App\Enums;

use App\Enums\Spain\Province;

enum City: string
{
    case BARCELONA = 'Barcelona';
    case MADRID = 'Madrid';
    case VALENCIA = 'Valencia';
    case SEVILLA = 'Sevilla';
    case ZARAGOZA = 'Zaragoza';
    case MALAGA = 'Málaga';
    case MURCIA = 'Murcia';
    case PALMA = 'Palma de Mallorca';
    case LAS_PALMAS = 'Las Palmas de Gran Canaria';
    case ALICANTE = 'Alicante';
    case CORDOBA = 'Córdoba';
    case GRANADA = 'Granada';
    case TOLEDO = 'Toledo';
    case SANTA_CRUZ = 'Santa Cruz de Tenerife';
    case BILBAO = 'Bilbao';
    case A_CORUNA = 'A Coruña';
    case OVIEDO = 'Oviedo';
    case SANTANDER = 'Santander';
    case OURENSE = 'Ourense';
    case PAMPLONA = 'Pamplona';

    public function province(): Province
    {
        return match ($this) {
            self::BARCELONA => Province::BARCELONA,
            self::MADRID => Province::MADRID,
            self::VALENCIA => Province::VALENCIA,
            self::SEVILLA => Province::SEVILLA,
            self::ZARAGOZA => Province::ZARAGOZA,
            self::MALAGA => Province::MALAGA,
            self::MURCIA => Province::MURCIA,
            self::PALMA => Province::BALEARES,
            self::LAS_PALMAS => Province::LAS_PALMAS,
            self::ALICANTE => Province::ALICANTE,
            self::CORDOBA => Province::CORDOBA,
            self::GRANADA => Province::GRANADA,
            self::TOLEDO => Province::TOLEDO,
            self::SANTA_CRUZ => Province::TENERIFE,
            self::BILBAO => Province::BIZKAIA,
            self::A_CORUNA => Province::A_CORUNA,
            self::OVIEDO => Province::ASTURIAS,
            self::SANTANDER => Province::CANTABRIA,
            self::OURENSE => Province::OURENSE,
            self::PAMPLONA => Province::NAVARRA,
        };
    }
}
