<?php

namespace App\Enums\Alerts;

enum typeAndSubtipe: string
{
    // Notices
    case MEDICATION = 'avisos.medicació';
    case SPECIALS_ALERT = 'avisos.Especials o per alerta';

    // Follow-up according to protocols
    case EMERGENCIES = 'Seguiment segons protocols.Després d’emergències';
    case GRIEF = 'Seguiment segons protocols.Per processos de dol';
    case HOSPITAL_DISCHARGES = 'Seguiment segons protocols.Per altes hospitalàries';

    // Schedules for home absence and return
    case TEMPORARY_SERVICE_SUSPENSION = 'Agendes d’absència domiciliària i retorn.Suspensió temporal del servei';
    case RETURNS_END_ABSENCE = 'Agendes d’absència domiciliària i retorn.Retorns o fi de l’absència';

    // Method to get the main category
    public function category(): string
    {
        return match ($this) {
            self::MEDICATION, self::SPECIALS_ALERT => 'Aviso',
            self::EMERGENCIES, self::GRIEF, self::HOSPITAL_DISCHARGES => 'Seguiment segons protocols',
            self::TEMPORARY_SERVICE_SUSPENSION, self::RETURNS_END_ABSENCE => 'Agendes d’absència domiciliària i retorn',
        };
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
