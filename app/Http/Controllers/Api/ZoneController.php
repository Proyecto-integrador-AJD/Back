<?php

namespace App\Http\Controllers\Api;

use App\Models\Zone;
use App\Http\Requests\Zone\{ZoneStoreRequest, ZoneUpdateRequest};
use App\Http\Resources\ZoneResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Zones API",
 *     version="1.0.0",
 *     description="API para gestionar los pacientes."
 * )
 */
class ZoneController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/zones",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista paginada de pacientes.",
     *     tags={"Zones"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Zones"))
     *     )
     * )
     */
    public function index()
    {
        return ZoneResource::collection(Zone::paginate());
    }

    /**
     * @OA\Get(
     *     path="/api/zones/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de un paciente específico por su ID.",
     *     tags={"Zones"},
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
     *         @OA\JsonContent(ref="/components/schemas/Zones")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function show(Zone $zone)
    {
        return $this->sendResponse(new ZoneResource($zone), 'Paciente recuperado con éxito', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/zones",
     *     summary="Crear un nuevo paciente",
     *     description="Crea un nuevo paciente con los datos proporcionados.",
     *     tags={"Zones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StoreZoneRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Zones")
     *     )
     * )
     */
    public function store(ZoneStoreRequest $request)
    {
        $zone = Zone::create($request->validated());
        return $this->sendResponse($zone, 'Paciente creado con éxito', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/zones/{id}",
     *     summary="Actualizar un paciente",
     *     description="Actualiza los datos de un paciente existente.",
     *     tags={"Zones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/UpdateZoneRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Zones")
     *     )
     * )
     */
    public function update(Zone $zone, ZoneUpdateRequest $request)
    {
        $zone->update($request->validated());
        return $this->sendResponse($zone, 'Paciente actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/zones/{id}",
     *     summary="Eliminar un paciente",
     *     description="Elimina un paciente específico por su ID.",
     *     tags={"Zones"},
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
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
