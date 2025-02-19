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
     /**
     * @OA\Get(
     *     path="/api/patients/zone/{id}",
     *     summary="Obtener pacientes por zona",
     *     description="Devuelve una lista de pacientes de una zona específica.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pacientes de la zona devueltos con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PatientResource"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron pacientes en la zona."
     *     )
     * )
     */
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
  /**
     * @OA\Get(
     *     path="/api/patients/current",
     *     summary="Obtener pacientes del usuario autenticado",
     *     description="Devuelve la lista de pacientes asignados al usuario autenticado.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="Pacientes devueltos con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PatientResource"))
     *     )
     * )
     */
    public function current(Request $request){
        // Obtiene el usuario autenticado
        $authUser = Auth::user();
        
        // Obtiene todos los pacientes asignados al usuario
        $patients = $authUser->patients()->get(); // Asegúrate de ejecutar la consulta
    
        return $this->sendResponse(PatientResource::collection($patients), 'Pacientes del usuario actual recuperados con éxito', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/patients",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista de todos los pacientes.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/PatientResource"))
     *     )
     * )
     */
    public function index()
    {
        return PatientResource::collection(Patient::all());
    }

     /**
     * @OA\Get(
     *     path="/api/patients/{id}",
     *     summary="Obtener un paciente por ID",
     *     description="Devuelve los datos de un paciente por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente recuperado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/PatientResource")
     *     )
     * )
     */
    public function show(Patient $patient)
    {
        return $this->sendResponse(new PatientResource($patient), 'Paciente recuperado con éxito', 200);
    }

   /**
     * @OA\Post(
     *     path="/api/patients",
     *     summary="Crear un nuevo paciente",
     *     description="Crea un nuevo paciente con los datos proporcionados.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PatientStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/PatientResource")
     *     )
     * )
     */
    public function store(PatientStoreRequest $request)
    {
        $patient = Patient::create($request->validated());
        return $this->sendResponse($patient, 'Paciente creado con éxito', 201);
    }

   /**
     * @OA\Put(
     *     path="/api/patients/{id}",
     *     summary="Actualizar un paciente",
     *     description="Actualiza los datos de un paciente existente.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PatientUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/PatientResource")
     *     )
     * )
     */
    public function update(Patient $patient, PatientUpdateRequest $request)
    {
        $patient->update($request->validated());
        return $this->sendResponse($patient, 'Paciente actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/patients/{id}",
     *     summary="Eliminar un paciente",
     *     description="Elimina un paciente por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente eliminado con éxito."
     *     )
     * )
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
