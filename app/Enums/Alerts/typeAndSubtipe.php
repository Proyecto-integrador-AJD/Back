<?php

namespace App\Enums\Alerts;

enum typeAndSubtipe: string
{
    // Notices
    case MEDICATION = 'medicació';
    case SPECIALS_ALERT = 'Especials o per alerta';

    // Follow-up according to protocols
    case EMERGENCIES = 'Després d’emergències';
    case GRIEF = 'Per processos de dol';
    case HOSPITAL_DISCHARGES = 'Per altes hospitalàries';

    // Schedules for home absence and return
    case TEMPORARY_SERVICE_SUSPENSION = 'Suspensió temporal del servei';
    case RETURNS_END_ABSENCE = 'Retorns o fi de l’absència';

    // Method to get the main category
    public function getCategory(): string
    {
        return match ($this) {
            self::MEDICATION, self::SPECIALS_ALERT => 'Aviso',
            self::EMERGENCIES, self::GRIEF, self::HOSPITAL_DISCHARGES => 'Seguiment segons protocols',
            self::TEMPORARY_SERVICE_SUSPENSION, self::RETURNS_END_ABSENCE => 'Agendes d’absència domiciliària i retorn',
        };
    }

    public static function getValues(): array
    {
        return [
            self::MEDICATION,
            self::SPECIALS_ALERT,
            self::EMERGENCIES,
            self::GRIEF,
            self::HOSPITAL_DISCHARGES,
            self::TEMPORARY_SERVICE_SUSPENSION,
            self::RETURNS_END_ABSENCE,
        ];
    }

    // Method to get the readable name
    // public function name(): string
    // {
    //     return match ($this) {
    //         self::MEDICATION => 'Medication notices',
    //         self::SPECIALS_ALERT => 'Special or alert notices',
    //         self::EMERGENCIES => 'Follow-up after emergencies',
    //         self::GRIEF => 'Follow-up for grief processes',
    //         self::HOSPITAL_DISCHARGES => 'Follow-up for hospital discharges',
    //         self::TEMPORARY_SERVICE_SUSPENSION => 'Temporary service suspension',
    //         self::RETURNS_END_ABSENCE => 'Returns or end of absence',
    //     };
    // }
}
