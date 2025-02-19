<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use App\Http\Requests\Patient\{PatientStoreRequest, PatientUpdateRequest};
use App\Http\Resources\PatientResource;
use App\Http\Controllers\Api\BaseController;
use Request;
use Illuminate\Support\Facades\Auth;


class PatientController extends BaseController
{
    public function getPatientsByZone($id)
    {
        // Buscar los pacientes de la zona específica
        $patients = Patient::where('zoneId', $id)->get();
    
        // Verificar si hay pacientes en la zona
        if ($patients->isEmpty()) {
            return $this->sendResponse([], 'No hay pacientes en esta zona', 200);
        }
    
        return $this->sendResponse(PatientResource::collection($patients), 'Pacientes de la zona recuperados con éxito', 200);
    }  

    public function current(Request $request){
        // Obtiene el usuario autenticado
        $authUser = Auth::user();
        
        // Obtiene todos los pacientes asignados al usuario
        $patients = $authUser->patients()->get(); // Asegúrate de ejecutar la consulta
    
        return $this->sendResponse(PatientResource::collection($patients), 'Pacientes del usuario actual recuperados con éxito', 200);
    }

    
    public function index()
    {
        return PatientResource::collection(Patient::all());
    }

    
    public function show(Patient $patient)
    {
        return $this->sendResponse(new PatientResource($patient), 'Paciente recuperado con éxito', 200);
    }

   
    public function store(PatientStoreRequest $request)
    {
        $patient = Patient::create($request->validated());
        return $this->sendResponse($patient, 'Paciente creado con éxito', 201);
    }

   
    public function update(Patient $patient, PatientUpdateRequest $request)
    {
        $patient->update($request->validated());
        return $this->sendResponse($patient, 'Paciente actualizado con éxito', 200);
    }

   
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
