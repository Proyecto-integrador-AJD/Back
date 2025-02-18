<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\User\{UserStoreRequest, UserUpdateRequest};
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\BaseController;


class UserController extends BaseController
{
   
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function show(User $user)
    {
        return $this->sendResponse(new UserResource($user), 'Usuario recuperado con éxito', 200);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());
        return $this->sendResponse($user, 'Usuario creado con éxito', 201);
    }

    
    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->validated());
        return $this->sendResponse($user, 'Usuario actualizado con éxito', 200);
    }

   
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse(null, 'Usuario eliminado con éxito', 200);
    }
}
