<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\Patient;
use App\Http\Resources\CallResource;
use App\Http\Resources\PatientResource;
use App\Http\Controllers\Api\BaseController;

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
}
