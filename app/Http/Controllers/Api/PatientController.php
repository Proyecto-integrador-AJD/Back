<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use App\Http\Requests\{UpdateJugadoraRequest, StoreJugadoraRequest};
use App\Http\Resources\JugadoraResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Patients API",
 *     version="1.0.0",
 *     description="API para gestionar las patients."
 * )
 */
class PatientController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/patients",
     *     summary="Obtener todas las patients",
     *     description="Devuelve una lista paginada de patients.",
     *     tags={"Patients"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de patients devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Patients"))
     *     )
     * )
     */
    public function index()
    {
        return JugadoraResource::collection(Patient::paginate());
    }

    /**
     * @OA\Get(
     *     path="/api/patients/{id}",
     *     summary="Obtener una jugadora",
     *     description="Devuelve los datos de una jugadora específica por su ID.",
     *     tags={"Patients"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la jugadora",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jugadora recuperada con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Patients")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jugadora no encontrada."
     *     )
     * )
     */
    // public function show(Patients $jugadora)
    // {
    //     return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora Recuperada amb èxit', 200);
    // }

    // /**
    //  * @OA\Post(
    //  *     path="/api/patients",
    //  *     summary="Crear una nueva jugadora",
    //  *     description="Crea una nueva jugadora con los datos proporcionados.",
    //  *     tags={"Patients"},
    //  *     @OA\RequestBody(
    //  *         required=true,
    //  *         @OA\JsonContent(ref="/components/schemas/StoreJugadoraRequest")
    //  *     ),
    //  *     @OA\Response(
    //  *         response=201,
    //  *         description="Jugadora creada con éxito.",
    //  *         @OA\JsonContent(ref="/components/schemas/Patients")
    //  *     )
    //  * )
    //  */
    // public function store(StoreJugadoraRequest $request)
    // {
    //     $jugadora = Patients::create($request->validated());
    //     return $this->sendResponse($jugadora, 'Jugadora Creada amb exit', 201);
    // }

    // /**
    //  * @OA\Put(
    //  *     path="/api/patients/{id}",
    //  *     summary="Actualizar una patients",
    //  *     description="Actualiza los datos de una jugadora existente.",
    //  *     tags={"Patients"},
    //  *     @OA\Parameter(
    //  *         name="id",
    //  *         in="path",
    //  *         description="ID de la jugadora",
    //  *         required=true,
    //  *         @OA\Schema(type="integer")
    //  *     ),
    //  *     @OA\RequestBody(
    //  *         required=true,
    //  *         @OA\JsonContent(ref="/components/schemas/UpdateJugadoraRequest")
    //  *     ),
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="Jugadora actualizada con éxito.",
    //  *         @OA\JsonContent(ref="/components/schemas/Patients")
    //  *     )
    //  * )
    //  */
    // public function update(Patients $jugadora, UpdateJugadoraRequest $request)
    // {
    //     $jugadora->update($request->validated());
    //     return $this->sendResponse($jugadora, 'Jugadora Actualitzada amb èxit', 200);
    // }

    // /**
    //  * @OA\Delete(
    //  *     path="/api/patients/{id}",
    //  *     summary="Eliminar una jugadora",
    //  *     description="Elimina una jugadora específica por su ID.",
    //  *     tags={"Patients"},
    //  *     @OA\Parameter(
    //  *         name="id",
    //  *         in="path",
    //  *         description="ID de la jugadora",
    //  *         required=true,
    //  *         @OA\Schema(type="integer")
    //  *     ),
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="Jugadora eliminada con éxito."
    //  *     ),
    //  *     @OA\Response(
    //  *         response=404,
    //  *         description="Jugadora no encontrada."
    //  *     )
    //  * )
    //  */
    // public function destroy(Patients $jugadora)
    // {
    //     $jugadora->delete();
    //     return $this->sendResponse(null, 'Patients Eliminada amb exit', 200);
    // }
}
