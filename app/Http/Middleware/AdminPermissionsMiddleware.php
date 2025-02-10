<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPermissionsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user(); // Usuario autenticado
        // Si el usuario no está autenticado, bloqueamos la acción
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        if (isset($request->role) && $request->role === 'admintrator' && !$user->isAdmin()) {
            return response()->json(['error' => 'No tienes permisos para realizar esta acción.'], 403);
        }

        // Bloquear la MODIFICACIÓN Y ELIMINAR de admins si el usuario no es admin
        if ($request->isMethod('put') || $request->isMethod('patch') || $request->isMethod('delete')) {
            $routeUser = $request->route('user'); // Usuario que se intenta modificar

            if ($routeUser && $routeUser->role === 'admintrator' && !$user->isAdmin()) {
                return response()->json(['error' => 'No tienes permisos para modificar administradores.'], 403);
            }
        }

        return $next($request);
    }
}
