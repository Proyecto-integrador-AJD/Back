<?php

namespace App\Enums\Calls\Outcoming;

enum TypeAndSubtipe: string
{
    // • Atenció d’emergències:
    case PLANNED_OR_SCHEDULED = 'Planificada o agendada';
    case NOT_PLANNED = 'No planificadas';




    // Method to get the main category
    public function getCategory(): string
    {

        return match ($this) {
            self::PLANNED_OR_SCHEDULED => 'Planificada o agendada',
            self::NOT_PLANNED => 'No planificadas',
        };
    }

    public static function getValues(): array
    {
        return [
            self::PLANNED_OR_SCHEDULED,
            self::NOT_PLANNED,
        ];
    }
}
