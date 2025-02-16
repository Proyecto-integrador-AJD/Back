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
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Log in a user",
     *     description="Authenticate user with email and password",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User signed in",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="your_token_here"),
     *                 @OA\Property(property="name", type="string", example="John Doe")
     *             ),
     *             @OA\Property(property="message", type="string", example="User signed in")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorised",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="incorrect Email/Password")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $result['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            $result['name'] = $authUser->name;

            return $this->sendResponse($result, 'User signed in');
        }
        return $this->sendError('Unauthorised.', ['error' => 'incorrect Email/Password']);
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     description="Register a user with name, email, and password",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password","confirm_password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123"),
     *             @OA\Property(property="confirm_password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User created successfully.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="your_token_here"),
     *                 @OA\Property(property="name", type="string", example="John Doe")
     *             ),
     *             @OA\Property(property="message", type="string", example="User created successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="object", example={"email": {"The email field is required."}})
     *         )
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
     *     summary="Log out a user",
     *     description="Invalidate the user's token",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="User successfully signed out.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="name", type="string", example="John Doe")
     *             ),
     *             @OA\Property(property="message", type="string", example="User successfully signed out.")
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
    public function user(Request $request){
        return $this->sendResponse(new UserResource($request->user()), 'Usuario recuperado con éxito', 200);
    }
}
