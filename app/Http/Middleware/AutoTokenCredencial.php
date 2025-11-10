<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AutoTokenCredencial
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si es la ruta /credencial y no tiene token
        if ($request->is('credencial') && !$request->has('token')) {
            
            // Verificar si el usuario está autenticado en Laravel
            if (Auth::check()) {
                try {
                    // Generar token JWT para el usuario autenticado
                    $token = JWTAuth::fromUser(Auth::user());
                    
                    // Redirigir a la misma ruta pero con el token
                    return redirect('/credencial?token=' . urlencode($token));
                    
                } catch (JWTException $e) {
                    // Si hay error al generar el token
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Error al generar token de acceso'
                    ], 500);
                }
            } else {
                // Si no está autenticado
                return response()->json([
                    'status' => 'error',
                    'message' => 'Debe iniciar sesión primero'
                ], 401);
            }
        }

        // Si no es la ruta /credencial o ya tiene token, continuar
        return $next($request);
    }
}
