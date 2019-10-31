<?php

namespace App\Http\Middleware;

use Closure;
use App\Rol;
use App\Utils\Http\HttpResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccessManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array $permisos
     * @return mixed
     */
    public function handle($request, Closure $next, $permisos)
    {
        $permisos = explode('|', $permisos);

        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return HttpResponse::unauthorized();
        }

        $userPermisos = $user->rol->permisos;

        foreach ($userPermisos as $userPermiso) {
            foreach ($permisos as $permiso) {
                if ($userPermiso->nombre == $permiso) {
                    return $next($request);
                }
            }
        }

        return HttpResponse::unauthorized();
    }
}
