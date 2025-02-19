<?php

namespace App\Http\Controllers\Api;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\Patient;
use App\Http\Resources\CallResource;
use App\Http\Resources\PatientResource;
use App\Http\Controllers\Api\BaseController;
use Dompdf\Dompdf;
use DateTime;
class ReportController extends BaseController
{
    /**
     * Obtener informes de actuaciones por emergencias.
     */
    public function getEmergencyReports()
    {
        $emergencyCalls = Call::where('type', 'LIKE', '%Emergència%')->get();

        return $this->sendResponse(CallResource::collection($emergencyCalls), 'Informes de emergencias recuperados con éxito', 200);
    }

    /**
     * Listar pacientes ordenados por apellidos.
     */
    public function getPatientsSorted()
    {
        $patients = Patient::orderBy('lastName', 'asc')->get();

        return $this->sendResponse(PatientResource::collection($patients), 'Pacientes ordenados por apellido', 200);
    }

    /**
     * Listar llamadas previstas para un día específico.
     */
    public function getScheduledCalls(Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $scheduledCalls = Call::whereDate('date', $date)->get();

        return $this->sendResponse(CallResource::collection($scheduledCalls), "Llamadas previstas para el día {$date}", 200);
    }

    /**
     * Listar llamadas realizadas en un día específico.
     */
    public function getDoneCalls(Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $doneCalls = Call::whereDate('date', $date)
            ->whereNotNull('duration') // Filtrar llamadas efectivas
            ->get();

        return $this->sendResponse(CallResource::collection($doneCalls), "Llamadas realizadas el {$date}", 200);
    }

    /**
     * Obtener el historial de llamadas de un paciente.
     */
    public function getPatientCallHistory($id)
    {
        $calls = Call::where('patientId', $id)->orderBy('date', 'desc')->get();

        if ($calls->isEmpty()) {
            return $this->sendResponse([], 'No hay historial de llamadas para este paciente', 200);
        }

        return $this->sendResponse(CallResource::collection($calls), 'Historial de llamadas del paciente recuperado con éxito', 200);
    }


    public function getReportHistoric(Request $request)
    {

    }

    /**
     * tiene que sacar o un pdf o csv con todas las llamadas previstas i realizadas las previstas son las alertas, y si tienen una llamada es que han sido realizadas
     * se puede filtrar por date, zona i type de call
     * la date sera un reango de fechas, la zona sera una id, i el type sera un string
     */
    private function getReportCalls($dateInit, $dateEnd, $zoneId, $type)
    {

        //! LLamadas sin alerta
        $query = Call::select('calls.date', 'zones.name as zone', 'calls.type', 'calls.subType', 'calls.duration', 'calls.description')
            ->join('patients', 'calls.patientId', '=', 'patients.id')
            ->join('users', 'calls.userId', '=', 'users.id')
            ->join('zones', 'patients.zoneId', '=', 'zones.id');

        $query->selectRaw("CONCAT(users.name, ' ', users.lastName) as operator");
        $query->selectRaw("CONCAT(patients.name, ' ', patients.lastName) as patient");


        $query->whereNull('calls.alertId');

        if ($dateInit != null) {
            $query->whereBetween('calls.date', [$dateInit, $dateEnd]);
        }

        if ($zoneId) {
            $query->where('patients.zoneId', $zoneId);
        }

        if ($type) {
            $query->where('calls.type', 'LIKE', "%$type%");
        }
        //! LLamadas sin alerta
        $noCalls = $query->get();


        //! LLamadas con alerta
        $query = Alert::select(
            'calls.date', 'zones.name as zone', 'calls.type', 'calls.subType', 'calls.duration', 'calls.description',
            'alerts.type as alertType',
            'alerts.subType as alertSubType',
            'alerts.description as alertDescription',
            'alerts.startDate as alertStartDate',
            'alerts.recurrenceType as alertRecurrenceType'
        )
            ->join('calls', 'alerts.id', '=', 'calls.alertId')
            ->join('users', 'calls.userId', '=', 'users.id')
            ->join('patients', 'calls.patientId', '=', 'patients.id')
            ->join('zones', 'patients.zoneId', '=', 'zones.id');

        $query->selectRaw("CONCAT(users.name, ' ', users.lastName) as operator");
        $query->selectRaw("CONCAT(patients.name, ' ', patients.lastName) as patient");


        if ($dateInit != null) {
            $query->whereBetween('calls.date', [$dateInit, $dateEnd]);

        }

        if ($zoneId) {
            $query->where('patients.zoneId', $zoneId);
        }

        if ($type) {
            $query->where('calls.type', 'LIKE', "%$type%");
        }

        $calls = $query->get();

        // dd($calls, $dateInit, $dateEnd, $zoneId, $type);
        return ['calls' => ['previstas' => $calls, 'noPrevistas' => $noCalls], 'filter' => ['dateInit' => $dateInit, 'dateEnd' => $dateEnd, 'zoneId' => $zoneId, 'type' => $type]];

    }

    public function getPDFcalls(Request $request)
    {
        // dd('hola');
        // hay que generar un pdf mediante DOMPDF en base a la funcion getReportCalls
        $dateInit = $request->query('dateInit', null);
        $dateInit = $dateInit ? date('Y-m-d H:i:s', strtotime($dateInit)) : null;
        $dateEnd = $request->query('dateEnd', now()->toDateString());
        $dateEnd = $dateEnd ? date('Y-m-d H:i:s', strtotime($dateEnd)) : null;

        $zoneId = $request->query('zoneId', null);
        $type = $request->query('type', null);

        $result = $this->getReportCalls($dateInit, $dateEnd, $zoneId, $type);
        $calls = $result['calls'];
        $filter = $result['filter'];


        // dd($calls);
        $imagePath = public_path('img/logoIcon.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;

        $data = [
            'date' => now()->format('d-m-Y H:i'),
            'calls' => $calls,
            'filtros' => $filter,
            'pathLogo' => $imageSrc
        ];


        // $pdf = Dompdf::loadView('pdf.reporteCalls', $data);

        $pdf = new Dompdf();
        $html = view('pdf.reporteCalls', compact('data'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $response = response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="reporte_llamadas.pdf"')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;






        //! Generar alertas


        // $ejemloAlert = [
        //     "id" => 2,
        //     "patientId" => 5,
        //     "type" => "Follow-up in application according to protocols",
        //     "subType" => null,
        //     "description" => "Autem fugit odio quae odit.",
        //     "startDate" => "2025-02-05 23:36:03",
        //     "isRecurring" => 1,
        //     "recurrenceType" => "weekly",
        //     "recurrence" => 6
        // ];
        
        // $dateInit = new DateTime('2025-01-27 08:46:29');
        // $dateEnd = new DateTime('2025-07-27 08:46:29');
    
        // $resultado = $this->generateAlerts($dateInit, $dateEnd, $ejemloAlert);
        
        // foreach ($resultado as $alert) {
        //     echo $alert['startDate'] . PHP_EOL . '<br>';
        // }
    }

    // private function generateAlerts($dateInit, $dateEnd, $alert) {
    //     $alerts = [];
    //     $recurrence = $alert['recurrenceType'];
    //     $puntoInicio = null;
    //     $days = 0;
    
    //     if ($recurrence == 'daily') {
    //         $days = 1;
    //         $puntoInicio = clone $dateInit;
    //     } elseif ($recurrence == 'weekly') {
    //         $days = 7;
    //         $fechaAlerta = new DateTime($alert['startDate']);
    //         $diaSemana = (int)$fechaAlerta->format('w');
    
    //         for ($i = 0; $i < 7; $i++) {
    //             $diaSemanaActual = (int)$dateInit->format('w');
    //             if ($diaSemanaActual == $diaSemana) {
    //                 $puntoInicio = clone $dateInit;
    //                 break;
    //             }
    //             $dateInit->modify('+1 day');
    //         }
    //     } elseif ($recurrence == 'monthly') {
    //         $days = 30;
    //         $fechaAlerta = new DateTime($alert['startDate']);
    //         $diaMes = (int)$fechaAlerta->format('d');
    
    //         for ($i = 0; $i < 30; $i++) {
    //             $diaMesActual = (int)$dateInit->format('d');
    //             if ($diaMesActual == $diaMes) {
    //                 $puntoInicio = clone $dateInit;
    //                 break;
    //             }
    //             $dateInit->modify('+1 day');
    //         }
    //     }
    
    //     if ($puntoInicio) {
    //         $date = clone $puntoInicio;
    //         while ($date <= $dateEnd) {
    //             $copy = $alert;
    //             $copy['startDate'] = $date->format('Y-m-d H:i:s');
    //             $alerts[] = $copy;
    //             $date->modify("+$days days");
    //         }
    //     }
    //     return $alerts;
    // }


    public function getCSVcalls(Request $request)
    {
        // dd('hola');
        // hay que generar un pdf mediante DOMPDF en base a la funcion getReportCalls
        $dateInit = $request->query('dateInit', null);
        $dateInit = $dateInit ? date('Y-m-d H:i:s', strtotime($dateInit)) : null;
        $dateEnd = $request->query('dateEnd', now()->toDateString());
        $dateEnd = $dateEnd ? date('Y-m-d H:i:s', strtotime($dateEnd)) : null;

        $zoneId = $request->query('zoneId', null);
        $type = $request->query('type', null);

        $result = $this->getReportCalls($dateInit, $dateEnd, $zoneId, $type);
        $calls = $result['calls'];
        $filter = $result['filter'];

        $data = [
            'date' => now()->format('d-m-Y H:i'),
            'calls' => $calls,
            'filtros' => $filter
        ];

        $csv = view('pdf.reporteCallsCSV', compact('data'))->render();

        $response = response($csv, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="reporte_llamadas.csv"')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
    
}
