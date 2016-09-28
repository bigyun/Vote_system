<?php

namespace App\Http\Middleware;

use Closure;

class AccessControlAllowMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', config('app.APP_ANGULAR_URL'));
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept,X-Request-With');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;
    }

}