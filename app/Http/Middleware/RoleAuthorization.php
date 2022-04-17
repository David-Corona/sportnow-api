<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RoleAuthorization extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return $this->unauthorized('La sesión ha expirado. Por favor, loguea de nuevo.');
        } catch (TokenInvalidException $e) {
            return $this->unauthorized('Token inválido. Por favor, loguea de nuevo.');
        }catch (JWTException $e) {
            return $this->unauthorized('La petición debe contener token de autentificación.');
        }
        // Si está autentificado y tiene un rol válido
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }
        return $this->unauthorized();
    }

    private function unauthorized($message = null){
        return response()->json([
            'message' => $message ? $message : 'No tienes permisos para acceder al recurso.',
            'success' => false
        ], 401);
    }
}
