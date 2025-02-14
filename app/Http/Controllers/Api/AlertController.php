<?php

namespace App\Http\Controllers\Api;

use App\Models\Alert;
use App\Models\Patient;
use App\Http\Requests\Alert\{AlertStoreRequest, AlertUpdateRequest};
use App\Http\Resources\AlertResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Alerts API",
 *     version="1.0.0",
 *     description="API para gestionar los pacientes."
 * )
 */
class AlertController extends BaseController
{
    public function user()
    {
        $userId = auth()->id(); // Obtener ID del usuario autenticado
    
        // Obtener las alertas solo de los pacientes asignados al usuario actual
        $alerts = Alert::whereIn('patientId', Patient::where('userId', $userId)->pluck('id'))->get();
    
        return $this->sendResponse(AlertResource::collection($alerts), 'Alertas asignadas al usuario recuperadas con éxito', 200);
    }

    public function unassigned()
    {
        // Obtener todas las alertas cuyo ID no está en ninguna llamada
        $alerts = Alert::whereNotIn('id', function ($query) {
            $query->select('alertId')->from('calls');
        })->get();

        return $this->sendResponse(AlertResource::collection($alerts), 'Alertas sin llamas asignadas recuperadas con éxito', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/alerts",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista paginada de pacientes.",
     *     tags={"Alerts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Alerts"))
     *     )
     * )
     */
    public function index()
    {
        return AlertResource::collection(Alert::all());
    }

    /**
     * @OA\Get(
     *     path="/api/alerts/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de un paciente específico por su ID.",
     *     tags={"Alerts"},
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
     *         @OA\JsonContent(ref="/components/schemas/Alerts")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function show(Alert $alert)
    {
        return $this->sendResponse(new AlertResource($alert), 'Paciente recuperado con éxito', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/alerts",
     *     summary="Crear un nuevo paciente",
     *     description="Crea un nuevo paciente con los datos proporcionados.",
     *     tags={"Alerts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StoreAlertRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Alerts")
     *     )
     * )
     */
    public function store(AlertStoreRequest $request)
    {
        $alert = Alert::create($request->validated());
        return $this->sendResponse($alert, 'Paciente creado con éxito', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/alerts/{id}",
     *     summary="Actualizar un paciente",
     *     description="Actualiza los datos de un paciente existente.",
     *     tags={"Alerts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/UpdateAlertRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Alerts")
     *     )
     * )
     */
    public function update(Alert $alert, AlertUpdateRequest $request)
    {
        $alert->update($request->validated());
        return $this->sendResponse($alert, 'Paciente actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/alerts/{id}",
     *     summary="Eliminar un paciente",
     *     description="Elimina un paciente específico por su ID.",
     *     tags={"Alerts"},
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
    public function destroy(Alert $alert)
    {
        $alert->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
