<?php

namespace App\Http\Controllers\Api;

use App\Models\Call;
use App\Http\Requests\Call\{CallStoreRequest, CallUpdateRequest};
use App\Http\Resources\CallResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Calls API",
 *     version="1.0.0",
 *     description="API para gestionar los pacientes."
 * )
 */
class CallController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/calls",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista paginada de pacientes.",
     *     tags={"Calls"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Calls"))
     *     )
     * )
     */
    public function index()
    {
        return CallResource::collection(Call::paginate());
    }

    /**
     * @OA\Get(
     *     path="/api/calls/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de un paciente específico por su ID.",
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
     *         description="Paciente recuperado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Calls")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function show(Call $call)
    {
        return $this->sendResponse(new CallResource($call), 'Paciente recuperado con éxito', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/calls",
     *     summary="Crear un nuevo paciente",
     *     description="Crea un nuevo paciente con los datos proporcionados.",
     *     tags={"Calls"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StoreCallRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Calls")
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
     *     summary="Actualizar un paciente",
     *     description="Actualiza los datos de un paciente existente.",
     *     tags={"Calls"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/UpdateCallRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Calls")
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
     *     summary="Eliminar un paciente",
     *     description="Elimina un paciente específico por su ID.",
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
     *         description="Paciente eliminado con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function destroy(Call $call)
    {
        $call->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
