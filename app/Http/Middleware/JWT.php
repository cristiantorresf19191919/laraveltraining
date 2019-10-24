<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Registramos nuestro middleware en el archivo Kernel.php en $routeMiddleware, añadimos la siguiente linea
        JWTAuth::parseToken()->authenticate();
        return $next($request);
    }
}
