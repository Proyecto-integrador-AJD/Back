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
        $query = Call::select(
            'calls.*',
            'patients.zoneId',
            'alerts.type as alertType',
            'alerts.subType as alertSubType',
            'alerts.description as alertDescription',
            'alerts.startDate as alertStartDate',
            'alerts.recurrenceType as alertRecurrenceType'
        )
            ->join('patients', 'calls.patientId', '=', 'patients.id')
            ->join('alerts', 'calls.alertId', '=', 'alerts.id');

        if ($dateInit != null) {
            $query->whereBetween('calls.date', [$dateInit, $dateEnd]);
        }

        if ($zoneId) {
            $query->where('patients.zoneId', $zoneId);
        }

        if ($type) {
            $query->where('calls.type', 'LIKE', "%$type%");
        }

        //! LLamadas con alerta
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
        // return $pdf->download('reporte.pdf'); // O return $pdf->stream(); para verlo en el navegador

    }
}
