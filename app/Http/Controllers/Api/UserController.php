<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\User\{UserStoreRequest, UserUpdateRequest};
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BaseController;

/**
 * @OA\Info(
 *     title="Users API",
 *     version="1.0.0",
 *     description="API para gestionar los pacientes."
 * )
 */
class UserController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Obtener todos los pacientes",
     *     description="Devuelve una lista paginada de pacientes.",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="/components/schemas/Users"))
     *     )
     * )
     */
    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Obtener un paciente",
     *     description="Devuelve los datos de un paciente específico por su ID.",
     *     tags={"Users"},
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
     *         @OA\JsonContent(ref="/components/schemas/Users")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente no encontrado."
     *     )
     * )
     */
    public function show(User $user)
    {
        return $this->sendResponse(new UserResource($user), 'Paciente recuperado con éxito', 200);
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Crear un nuevo paciente",
     *     description="Crea un nuevo paciente con los datos proporcionados.",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StoreUserRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Users")
     *     )
     * )
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        return $this->sendResponse($user, 'Paciente creado con éxito', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Actualizar un paciente",
     *     description="Actualiza los datos de un paciente existente.",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del paciente",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/UpdateUserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Users")
     *     )
     * )
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->validated());
        return $this->sendResponse($user, 'Paciente actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Eliminar un paciente",
     *     description="Elimina un paciente específico por su ID.",
     *     tags={"Users"},
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
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse(null, 'Paciente eliminado con éxito', 200);
    }
}
