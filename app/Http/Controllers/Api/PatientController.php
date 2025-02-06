<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use App\Http\Requests\Patient\{PatientStoreRequest, PatientUpdateRequest};
use App\Http\Resources\PatientResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Patients API",
 *     version="1.0.0",
 *     description="API para gestionar los pacientes."
 * )
 */
class PatientController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/patients",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista paginada de pacientes.",
     *     tags={"Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Patients"))
     *     )
     * )
     */
    public function index()
    {
        return PatientResource::collection(Patient::paginate());
    }

    /**
     * @OA\Get(
     *     path="/api/patients/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de un paciente específico por su ID.",
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
     *         @OA\JsonContent(ref="/components/schemas/Patients")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
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
     *     tags={"Patients"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StorePatientRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Patients")
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
     *         @OA\JsonContent(ref="/components/schemas/UpdatePatientRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Patients")
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
     *     description="Elimina un paciente específico por su ID.",
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
