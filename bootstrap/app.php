<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {})
    ->withExceptions(function (Exceptions $exceptions) {
        // Manejo específico para AuthenticationException
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->query('debug') === 'true') {
                dd($e); // Mostrar detalles del error en modo depuración
            }
            return response()->json([
                'success' => false,
                'route' => $request->path(),
                'verb' => $request->method(),
                'message' => 'No autorizado',
            ], 401); // Código de estado 401 para no autorizado
        });

        // Manejo general de excepciones
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->query('debug') === 'true') {
                dd($e); // Mostrar detalles del error en modo depuración
            }

            $statusCode = method_exists($e, 'getStatusCode')
                ? $e->getStatusCode()
                : ($e->status ?? 500);
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'route' => $request->path(),
                    'verb' => $request->method(),
                    'message' => $e->getMessage(),
                ], $statusCode);
            }

            // Para otras rutas, puedes decidir cómo manejar
            return response()->json(['message' => 'Error interno del servidor'], 500);
        });
    })
    ->create();
