<?php

namespace App\Enums;

enum PrefixPhone: string
{
    case SPAIN = '+34';
    case PORTUGAL = '+351';
    case FRANCE = '+33';
    case ANDORRA = '+376';
    case GIBRALTAR = '+350';
    case ITALY = '+39';
    case MOROCCO = '+212';

    public function country(): string
    {
        return match ($this) {
            self::SPAIN => 'España',
            self::PORTUGAL => 'Portugal',
            self::FRANCE => 'Francia',
            self::ANDORRA => 'Andorra',
            self::GIBRALTAR => 'Gibraltar',
            self::ITALY => 'Italia',
            self::MOROCCO => 'Marruecos',
        };
    }

    public static function getValues(): array
    {
        return [
            self::SPAIN,
            self::PORTUGAL,
            self::FRANCE,
            self::ANDORRA,
            self::GIBRALTAR,
            self::ITALY,
            self::MOROCCO,
        ];
    }
}
