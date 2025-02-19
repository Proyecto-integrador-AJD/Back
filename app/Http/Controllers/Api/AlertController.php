<?php

namespace App\Http\Controllers\Api;

use App\Models\Alert;
use App\Models\Patient;
use App\Http\Requests\Alert\{AlertStoreRequest, AlertUpdateRequest};
use App\Http\Resources\AlertResource;
use App\Http\Controllers\Api\BaseController;


class AlertController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/alerts/user",
     *     summary="Obtener alertas asignadas al usuario",
     *     description="Devuelve una lista de alertas asignadas al usuario autenticado.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\Response(
     *         response=200,
     *         description="Alertas asignadas al usuario recuperadas con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/AlertResource"))
     *     )
     * )
     */
    public function user()
    {
        $userId = auth()->id(); // Obtener ID del usuario autenticado
        $result = Patient::where('userId', $userId)->pluck('id')->toArray();
        $alerts = Alert::whereIn('patientId', $result)->get();
    
        return $this->sendResponse(AlertResource::collection($alerts), 'Alertas asignadas al usuario recuperadas con éxito', 200);
    }
/**
     * @OA\Get(
     *     path="/api/alerts/unassigned",
     *     summary="Obtener alertas sin llamadas asignadas",
     *     description="Devuelve las alertas que no están asociadas a ninguna llamada.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\Response(
     *         response=200,
     *         description="Alertas sin llamadas asignadas recuperadas con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/AlertResource"))
     *     )
     * )
     */
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
     *     summary="Obtener todas las alertas",
     *     description="Devuelve una lista de todas las alertas.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de alertas devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/AlertResource"))
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
     *     summary="Obtener una alerta específica",
     *     description="Devuelve los datos de una alerta específica por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la alerta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alerta recuperada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/AlertResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Alerta no encontrada."
     *     )
     * )
     */
   
    public function show(Alert $alert)
    {
        return $this->sendResponse(new AlertResource($alert), 'Alerta recuperada con éxito', 200);
    }

   /**
     * @OA\Post(
     *     path="/api/alerts",
     *     summary="Crear una nueva alerta",
     *     description="Crea una nueva alerta con los datos proporcionados.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AlertStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Alerta creada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/AlertResource")
     *     )
     * )
     */
    public function store(AlertStoreRequest $request)
    {
        $alert = Alert::create($request->validated());
        return $this->sendResponse($alert, 'Alerta creada con éxito', 201);
    }
  /**
     * @OA\Put(
     *     path="/api/alerts/{id}",
     *     summary="Actualizar una alerta",
     *     description="Actualiza los datos de una alerta existente.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la alerta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AlertUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alerta actualizada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/AlertResource")
     *     )
     * )
     */
    
    public function update(Alert $alert, AlertUpdateRequest $request)
    {
        $alert->update($request->validated());
        return $this->sendResponse($alert, 'Alerta actualizada con éxito', 200);
    }
 /**
     * @OA\Delete(
     *     path="/api/alerts/{id}",
     *     summary="Eliminar una alerta",
     *     description="Elimina una alerta específica por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Alerts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la alerta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alerta eliminada con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Alerta no encontrada."
     *     )
     * )
     */
   
    public function destroy(Alert $alert)
    {
        $alert->delete();
        return $this->sendResponse(null, 'Alerta eliminado con éxito', 200);
    }
}
