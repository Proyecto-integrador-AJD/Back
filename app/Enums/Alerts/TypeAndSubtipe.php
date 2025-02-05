<?php

namespace App\Enums\Alerts;

enum TypeAndSubtipe: string
{

    // Types
    case TYPE_WARNING = 'Aviso';
    case TYPE_FOLLOW_THE_PROTOCOL = 'Seguiment segons protocols';
    case TYPE_MONITORING_IN_APPLICATION_ACCORDING_TO_PROTOCOLS = 'Seguiment en aplicació segons protocols';
    case TYPE_HOME_ABSENCE_AND_RETURN_AGENDAS = 'Agendes d’absència domiciliària i retorn';

    // Notices
    case MEDICATION = 'medicació';
    case SPECIALS = 'Especials';
    case ALERT = 'per alerta';

    // Follow-up app de protocols
    case EMERGENCIES = 'Després d’emergències';
    case GRIEF = 'Per processos de dol';
    case HOSPITAL_DISCHARGES = 'Per altes hospitalàries';

    // Schedules for home absence and return
    case TEMPORARY_SERVICE_SUSPENSION = 'Suspensió temporal del servei';
    case ABSENCE_HOME = 'Ausencia domiciliarí';
    case RETURNS_END_ABSENCE = 'Retorns o fi de l’absència';

    // Method to get the main category
    public function getCategory(): TypeAndSubtipe
    {
        return match ($this) {
            self::MEDICATION, self::SPECIALS, self::ALERT => self::TYPE_WARNING,
            self::TYPE_FOLLOW_THE_PROTOCOL => self::TYPE_FOLLOW_THE_PROTOCOL,
            self::EMERGENCIES, self::GRIEF, self::HOSPITAL_DISCHARGES => self::TYPE_MONITORING_IN_APPLICATION_ACCORDING_TO_PROTOCOLS,
            self::TEMPORARY_SERVICE_SUSPENSION, self::ABSENCE_HOME, self::RETURNS_END_ABSENCE => self::TYPE_HOME_ABSENCE_AND_RETURN_AGENDAS,
        };
    }

    public static function getValues(): array
    {
        return [
            self::MEDICATION,
            self::SPECIALS,
            self::ALERT,
            self::TYPE_FOLLOW_THE_PROTOCOL,
            self::EMERGENCIES,
            self::GRIEF,
            self::HOSPITAL_DISCHARGES,
            self::TEMPORARY_SERVICE_SUSPENSION,
            self::ABSENCE_HOME,
            self::RETURNS_END_ABSENCE,
        ];
    }

    public static function getValuesType(): array{
        return [
            self::TYPE_WARNING,
            self::TYPE_FOLLOW_THE_PROTOCOL,
            self::TYPE_MONITORING_IN_APPLICATION_ACCORDING_TO_PROTOCOLS,
            self::TYPE_HOME_ABSENCE_AND_RETURN_AGENDAS,
        ];
    }
}
