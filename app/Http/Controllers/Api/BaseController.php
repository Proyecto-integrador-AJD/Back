<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/sendResponse",
     *     summary="Enviar respuesta exitosa",
     *     tags={"BaseController"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="result", type="string", example="Resultado exitoso"),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Respuesta exitosa",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="string", example="Resultado exitoso"),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     )
     * )
     */
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * @OA\Post(
     *     path="/api/sendError",
     *     summary="Enviar respuesta de error",
     *     tags={"BaseController"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error ocurrido"),
     *             @OA\Property(property="errorMessages", type="array", @OA\Items(type="string"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Respuesta de error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error ocurrido"),
     *             @OA\Property(property="info", type="array", @OA\Items(type="string"))
     *         )
     *     )
     * )
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['info'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}