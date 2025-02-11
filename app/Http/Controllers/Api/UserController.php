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
 *     description="API para gestionar los usuarios."
 * )
 */
class UserController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Obtener todos los usuarios",
     *     description="Devuelve una lista paginada de usuarios.",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuarios devuelta con éxito.",
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
     *     summary="Obtener un usuario",
     *     description="Devuelve los datos de un usuario específico por su ID.",
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
     *         @OA\JsonContent(ref="/components/schemas/Users")
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
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="/components/schemas/StoreUserRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario creado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Users")
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
     *         @OA\JsonContent(ref="/components/schemas/UpdateUserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario actualizado con éxito.",
     *         @OA\JsonContent(ref="/components/schemas/Users")
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
     *     description="Elimina un usuario específico por su ID.",
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
