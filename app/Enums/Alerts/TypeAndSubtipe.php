<?php

namespace App\Enums\Alerts;

enum TypeAndSubtipe: string
{
    // Notices
    case MEDICATION = 'medicació';
    case SPECIALS = 'Especials';
    case ALERT = 'per alerta';

    // Follow-up according to protocols
    case FOLLOW_THE_PROTOCOL = 'Seguiment segons protocols';

    // Follow-up app de protocols
    case EMERGENCIES = 'Després d’emergències';
    case GRIEF = 'Per processos de dol';
    case HOSPITAL_DISCHARGES = 'Per altes hospitalàries';

    // Schedules for home absence and return
    case TEMPORARY_SERVICE_SUSPENSION = 'Suspensió temporal del servei';
    case ABSENCE_HOME = 'Ausencia domiciliarí';
    case RETURNS_END_ABSENCE = 'Retorns o fi de l’absència';

    // Method to get the main category
    public function getCategory(): string
    {
        return match ($this) {
            self::MEDICATION, self::SPECIALS, self::ALERT => 'Aviso',
            self::FOLLOW_THE_PROTOCOL => 'Seguiment segons protocols',
            self::EMERGENCIES, self::GRIEF, self::HOSPITAL_DISCHARGES => 'Seguiment segons protocols',
            self::TEMPORARY_SERVICE_SUSPENSION, self::ABSENCE_HOME, self::RETURNS_END_ABSENCE => 'Agendes d’absència domiciliària i retorn',
        };
    }

    public static function getValues(): array
    {
        return [
            self::MEDICATION,
            self::SPECIALS,
            self::ALERT,
            self::FOLLOW_THE_PROTOCOL,
            self::EMERGENCIES,
            self::GRIEF,
            self::HOSPITAL_DISCHARGES,
            self::TEMPORARY_SERVICE_SUSPENSION,
            self::ABSENCE_HOME,
            self::RETURNS_END_ABSENCE,
        ];
    }
}
