<?php

namespace App\Enums\Calls\Incoming;

enum TypeAndSubtipe: string
{
    // • Atenció d’emergències:
    case SOCIAL_EMERGENCIES = 'Emergències socials';
    case HEALTH_EMERGENCIES = 'Emergències sanitàries';
    case LONELINESS_OR_ANGUISH_CRISIS = 'Crisi de soledat o angoixa';
    case UNANSWERED_ALARM = 'Alarma sense resposta';


    // • Comunicacions no urgents:
    case ABSENCES_OR_RETURNS = 'Notificar absències o retorns';
    case MODIFY_PERSONAL_DATA = 'Modificar dades personals';
    case ACCIDENTAL_CALLS = 'Cridades accidentals';
    case INFORMATION_REQUEST = 'Petició d’informació';
    case SUGGESTIONS_COMPLAINTS_OR_CLAIMS = 'Formulació de suggeriments, queixes o reclamacions';
    case SOCIAL_CALLS = 'Cridades socials';
    case REGISTER_MEDICAL_APPOINTMENTS = 'Registrar cites mèdiques';
    case OTHER_CALLS = 'Altres tipus de crides';




    // Method to get the main category
    public function getCategory(): string
    {

        return match ($this) {
            self::SOCIAL_EMERGENCIES, self::HEALTH_EMERGENCIES, self::LONELINESS_OR_ANGUISH_CRISIS, self::UNANSWERED_ALARM => 'Atenció d’emergències',
            self::ABSENCES_OR_RETURNS, self::MODIFY_PERSONAL_DATA, self::ACCIDENTAL_CALLS, self::INFORMATION_REQUEST, self::SUGGESTIONS_COMPLAINTS_OR_CLAIMS, self::SOCIAL_CALLS, self::REGISTER_MEDICAL_APPOINTMENTS, self::OTHER_CALLS => 'Comunicacions no urgents',
        };
    }

    public static function getValues(): array
    {
        return [
            self::SOCIAL_EMERGENCIES,
            self::HEALTH_EMERGENCIES,
            self::LONELINESS_OR_ANGUISH_CRISIS,
            self::UNANSWERED_ALARM,
            self::ABSENCES_OR_RETURNS,
            self::MODIFY_PERSONAL_DATA,
            self::ACCIDENTAL_CALLS,
            self::INFORMATION_REQUEST,
            self::SUGGESTIONS_COMPLAINTS_OR_CLAIMS,
            self::SOCIAL_CALLS,
            self::REGISTER_MEDICAL_APPOINTMENTS,
            self::OTHER_CALLS,
        ];
    }
}
