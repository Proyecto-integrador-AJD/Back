<?php

namespace App\Enums\Alerts;

enum RecurrenceType: string
{
    case DAILY = 'Diàri';
    case WEEKLY = 'Setmanal';
    case MONTHLY = 'Mensual';
    case YEARLY = 'Anual';

    public static function getValues(): array
    {
        return [
            self::DAILY,
            self::WEEKLY,
            self::MONTHLY,
            self::YEARLY,
        ];
    }
}
