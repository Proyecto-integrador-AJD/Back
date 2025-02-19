<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\UserStoreRequest;

class AuthController extends BaseController
{
    
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $authUser = Auth::user();
            $result['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            $result['name'] = $authUser->name;

            return $this->sendResponse($result, 'User signed in');
        }
        return $this->sendError('Unauthorised.', ['error' => 'incorrect Username/Password']);
    }

    
    public function register(UserStoreRequest $request)
    {

        try {
            $validatedData = $request->validated();

            // Verifica que 'confirm_password' sea igual a 'password'
            if ($validatedData['password'] !== $request->input('confirm_password')) {
                return $this->sendError('Error validation', ['confirm_password' => 'La confirmación de contraseña no coincide.']);
            }

            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['role'] = 'operator';

            $user = User::create($validatedData);
            $result['token'] = $user->createToken('MyAuthApp')->plainTextToken;
            $result['name'] = $user->name;

            return $this->sendResponse($result, 'User created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('Registration Error', $e->getMessage());
        }
    }


   
    public function logout(Request $request)
    {
        $user = $request->user(); // or Auth::user()
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        $success['name'] = $user->username;

        return $this->sendResponse($success, 'User successfully signed out.');
    }

    /**
     * Infomacion de user logueado
     */
    public function user(Request $request){
        return $this->sendResponse(new UserResource($request->user()), 'Usuario recuperado con éxito', 200);
    }
}
