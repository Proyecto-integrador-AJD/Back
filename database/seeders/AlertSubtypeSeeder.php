<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlertSubtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
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
        */

        $alertSubtypes = [ 
        [
            'alertTypeName' => 'Notice',
            'name' => 'medication',
            'spanishName' => 'medicación',
            'valencianName' => 'medicació',
        ],
        [
            'alertTypeName' => 'Notice',
            'name' => 'Specials',
            'spanishName' => 'Especiales',
            'valencianName' => 'Especials',
        ],
        [
            'alertTypeName' => 'Notice',
            'name' => 'per alert',
            'spanishName' => 'por alerta',
            'valencianName' => 'per alerta',
        ],
        [
            'alertTypeName' => 'Follow-up according to protocols',
            'name' => 'After emergencies',
            'spanishName' => 'Después de emergencias',
            'valencianName' => 'Després d’emergències',
        ],
        [
            'alertTypeName' => 'Follow-up according to protocols',
            'name' => 'For grief processes',
            'spanishName' => 'Por procesos de duelo',
            'valencianName' => 'Per processos de dol',
        ],
        [
            'alertTypeName' => 'Follow-up according to protocols',
            'name' => 'For hospital discharges',
            'spanishName' => 'Por altas hospitalarias',
            'valencianName' => 'Per altes hospitalàries',
        ],
        [
            'alertTypeName' => 'Home absence and return agendas',
            'name' => 'Temporary service suspension',
            'spanishName' => 'Suspensión temporal del servicio',
            'valencianName' => 'Suspensió temporal del servei',
        ],
        [
            'alertTypeName' => 'Home absence and return agendas',
            'name' => 'Home absence',
            'spanishName' => 'Ausencia domiciliaria',
            'valencianName' => 'Ausència domiciliària',
        ],
        [
            'alertTypeName' => 'Home absence and return agendas',
            'name' => 'Returns or end of absence',
            'spanishName' => 'Retornos o fin de la ausencia',
            'valencianName' => 'Retorns o fi de l’absència',
        ],
    ];        

        foreach ($alertSubtypes as $alertSubtype) {
            \App\Models\AlertSubtype::create($alertSubtype);
        }

    }
}
