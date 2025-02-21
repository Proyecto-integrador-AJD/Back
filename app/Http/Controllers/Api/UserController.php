<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\User\{UserStoreRequest, UserUpdateRequest};
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BaseController;


class UserController extends BaseController
{
   /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Obtener todos los usuarios",
     *     description="Devuelve una lista de todos los usuarios.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuarios devuelta con éxito.",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserResource"))
     *     )
     * )
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }
 /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     summary="Obtener un usuario",
     *     description="Devuelve los datos de un usuario por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario recuperado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuario no encontrado."
     *     )
     * )
     */
    public function show(User $user)
    {
        return $this->sendResponse(new UserResource($user), 'Usuario recuperado con éxito', 200);
    }
  /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Crear un nuevo usuario",
     *     description="Crea un nuevo usuario con los datos proporcionados.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserStoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario creado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     )
     * )
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        return $this->sendResponse($user, 'Usuario creado con éxito', 201);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Actualizar un usuario",
     *     description="Actualiza los datos de un usuario existente.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario actualizado con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     )
     * )
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->validated());
        return $this->sendResponse($user, 'Usuario actualizado con éxito', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Eliminar un usuario",
     *     description="Elimina un usuario por su ID.",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario eliminado con éxito."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuario no encontrado."
     *     )
     * )
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse(null, 'Usuario eliminado con éxito', 200);
    }
}
