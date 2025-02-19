<?php

namespace App\Http\Controllers\Api;

use App\Models\Call;
use App\Http\Requests\Call\{CallStoreRequest, CallUpdateRequest};
use App\Http\Resources\CallResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Tag(
 *     name="Calls",
 *     description="Operaciones relacionadas con las llamadas"
 * )
 */

class CallController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/api/calls/patient/{id}",
     *     summary="Obtener todas las llamadas de un paciente",
     *     description="Devuelve una lista de llamadas asociadas a un paciente específico.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Calls"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de llamadas del paciente devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CallResource"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function getCallsByPatient($id)
    {
        // Buscar las llamadas asociadas al paciente
        $calls = Call::where('patientId', $id)->get();

        // Verificar si hay llamadas
        if ($calls->isEmpty()) {
            return $this->sendResponse([], 'No hay llamadas para este paciente', 200);
        }

        return $this->sendResponse(CallResource::collection($calls), 'Llamadas del paciente recuperadas con éxito', 200);
    }
 /**
     * @OA\Get(
     *     path="/api/calls",
     *     summary="Obtener todas las llamadas",
     *     description="Devuelve una lista paginada de llamadas.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Calls"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de llamadas devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CallResource"))
     *     )
     * )
     */
    public function index()
    {
        return CallResource::collection(Call::all());
    }

    
    /**
     * @OA\Get(
     *     path="/api/calls/{id}",
     *     summary="Obtener una llamada",
     *     description="Devuelve los datos de una llamada específica por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Calls"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la llamada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Llamada recuperada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/CallResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Llamada no encontrada."
     *     )
     * )
     *
     */

    public function show(Call $call)
    {
        return $this->sendResponse(new CallResource($call), 'Paciente recuperado con éxito', 200);
    }

/**
     * @OA\Post(
     *     path="/api/calls",
     *     summary="Crear una nueva llamada",
     *     description="Crea una nueva llamada con los datos proporcionados.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Calls"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CallStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Llamada creada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/CallResource")
     *     )
     * )
     */
   
    public function store(CallStoreRequest $request)
    {
        $call = Call::create($request->validated());
        return $this->sendResponse($call, 'Paciente creado con éxito', 201);
    }
 /**
     * @OA\Put(
     *     path="/api/calls/{id}",
     *     summary="Actualizar una llamada",
     *     description="Actualiza los datos de una llamada existente.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Calls"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la llamada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CallUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Llamada actualizada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/CallResource")
     *     )
     * )
     */
    
    public function update(Call $call, CallUpdateRequest $request)
    {
        $call->update($request->validated());
        return $this->sendResponse($call, 'Paciente actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/calls/{id}",
     *     summary="Eliminar una llamada",
     *     description="Elimina una llamada específica por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Calls"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la llamada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Llamada eliminada con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Llamada no encontrada."
     *     )
     * )
     */
    public function destroy(Call $call)
    {
        $call->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
