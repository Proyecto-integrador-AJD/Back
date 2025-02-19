<?php

namespace App\Http\Controllers\Api;

use App\Models\Zone;
use App\Http\Requests\Zone\{ZoneStoreRequest, ZoneUpdateRequest};
use App\Http\Resources\ZoneResource;
use App\Http\Controllers\Api\BaseController;


class ZoneController extends BaseController
{  

    /**
     * @OA\Get(
     *     path="/api/zones",
     *     summary="Obtener todas las zonas",
     *     description="Devuelve una lista paginada de zonas.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Zones"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de zonas devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ZoneResource"))
     *     )
     * )
     */
    public function index()
    {
        return ZoneResource::collection(Zone::all());
    }

    /**
     * @OA\Get(
     *     path="/api/zones/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de una zona específico por su ID.",
     *     tags={"Zones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zona recuperada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/ZoneResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zona no encontrado."
     *     )
     * )
     */
    public function show(Zone $zone)
    {
        return $this->sendResponse(new ZoneResource($zone), 'Zona recuperada con éxito', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/zones",
     *     summary="Crear una nueva zona",
     *     description="Crea una nuevo zona con los datos proporcionados.",
     *     tags={"Zones"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ZoneStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Zona creada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/ZoneResource")
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
     *     summary="Actualizar una zona",
     *     description="Actualiza los datos de una zona existente.",
     *     tags={"Zones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ZoneUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zona actualizada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/ZoneResource")
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
     *     summary="Eliminar una zona",
     *     description="Elimina una zona específico por su ID.",
     *     tags={"Zones"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zona eliminado con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zona no encontrada."
     *     )
     * )
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
