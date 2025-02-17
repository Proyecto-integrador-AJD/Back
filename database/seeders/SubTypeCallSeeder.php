<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubTypeCall;
use App\Models\TypeCall;

class SubTypeCallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los TypeCall existentes
        $typeCalls = TypeCall::all()->keyBy('name');

        $subTypeCalls = [
            // Atenció d’emergències
            [
                'name' => 'Social Emergencies',
                'spanishName' => 'Emergencias sociales',
                'valencianName' => 'Emergències socials',
                'incoming' => true,
                'typecall_id' => $typeCalls['Emergency Attention']->id ?? null,
            ],
            [
                'name' => 'Health Emergencies',
                'spanishName' => 'Emergencias sanitarias',
                'valencianName' => 'Emergències sanitàries',
                'incoming' => true,
                'typecall_id' => $typeCalls['Emergency Attention']->id ?? null,
            ],
            [
                'name' => 'Planned or Scheduled',
                'spanishName' => 'Planificada o agendada',
                'valencianName' => 'Planificada o agendada',
                'incoming' => false,
                'typecall_id' => $typeCalls['Emergency Attention']->id ?? null,
            ],
            [
                'name' => 'Not Planned',
                'spanishName' => 'No planificadas',
                'valencianName' => 'No planificades',
                'incoming' => false,
                'typecall_id' => $typeCalls['Emergency Attention']->id ?? null,
            ],
            [
                'name' => 'Loneliness or Anguish Crisis',
                'spanishName' => 'Crisis de soledad o angustia',
                'valencianName' => 'Crisi de soledat o angoixa',
                'incoming' => true,
                'typecall_id' => $typeCalls['Emergency Attention']->id ?? null,
            ],
            [
                'name' => 'Unanswered Alarm',
                'spanishName' => 'Alarma sin respuesta',
                'valencianName' => 'Alarma sense resposta',
                'incoming' => true,
                'typecall_id' => $typeCalls['Emergency Attention']->id ?? null,
            ],
            [
                'name' => 'Absences or Returns Notification',
                'spanishName' => 'Notificación de ausencias o retornos',
                'valencianName' => 'Notificar absències o retorns',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Modify Personal Data',
                'spanishName' => 'Modificar datos personales',
                'valencianName' => 'Modificar dades personals',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Accidental Calls',
                'spanishName' => 'Llamadas accidentales',
                'valencianName' => 'Cridades accidentals',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Information Request',
                'spanishName' => 'Solicitud de información',
                'valencianName' => 'Petició d’informació',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Suggestions, Complaints or Claims',
                'spanishName' => 'Formulación de sugerencias, quejas o reclamaciones',
                'valencianName' => 'Formulació de suggeriments, queixes o reclamacions',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Social Calls',
                'spanishName' => 'Llamadas sociales',
                'valencianName' => 'Cridades socials',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Register Medical Appointments',
                'spanishName' => 'Registrar citas médicas',
                'valencianName' => 'Registrar cites mèdiques',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],
            [
                'name' => 'Other Calls',
                'spanishName' => 'Otros tipos de llamadas',
                'valencianName' => 'Altres tipus de crides',
                'incoming' => true,
                'typecall_id' => $typeCalls['Non-Urgent Communications']->id ?? null,
            ],

        ];

        // Insertar los registros solo si tienen un typecall_id válido
        foreach ($subTypeCalls as $subTypeCall) {
            if ($subTypeCall['typecall_id']) {
                SubTypeCall::create($subTypeCall);
            }
        }
    }
}
