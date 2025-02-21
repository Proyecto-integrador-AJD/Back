<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\UserStoreRequest;


/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Autenticación"
 * )
 */

class AuthController extends BaseController
{
    
     /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Iniciar sesión",
     *     description="Permite iniciar sesión a un usuario con nombre de usuario y contraseña.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"username", "password"},
     *             @OA\Property(property="username", type="string", description="Nombre de usuario del usuario."),
     *             @OA\Property(property="password", type="string", description="Contraseña del usuario.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario autenticado con éxito.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="token", type="string", description="Token de acceso."),
     *             @OA\Property(property="name", type="string", description="Nombre del usuario.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales no válidas."
     *     )
     * )
     */
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

     /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Registrar un nuevo usuario",
     *     description="Registra un nuevo usuario con un rol predeterminado de 'operator'.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name", "email", "username", "password", "confirm_password"},
     *             @OA\Property(property="name", type="string", description="Nombre del usuario."),
     *             @OA\Property(property="email", type="string", description="Correo electrónico del usuario."),
     *             @OA\Property(property="username", type="string", description="Nombre de usuario único."),
     *             @OA\Property(property="password", type="string", description="Contraseña."),
     *             @OA\Property(property="confirm_password", type="string", description="Confirmación de la contraseña.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario registrado con éxito.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="token", type="string", description="Token de acceso."),
     *             @OA\Property(property="name", type="string", description="Nombre del usuario.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación de la contraseña."
     *     )
     * )
     */
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

  /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Cerrar sesión",
     *     description="Finaliza la sesión del usuario autenticado.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Usuario cerrado sesión con éxito.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", description="Nombre del usuario que cerró la sesión.")
     *         )
     *     )
     * )
     */
   
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
     /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Obtener la información del usuario autenticado",
     *     description="Devuelve la información del usuario actualmente autenticado.",
     *     tags={"Authentication"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Información del usuario recuperada con éxito.",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     )
     * )
     */
    public function user(Request $request){
        return $this->sendResponse(new UserResource($request->user()), 'Usuario recuperado con éxito', 200);
    }
}
