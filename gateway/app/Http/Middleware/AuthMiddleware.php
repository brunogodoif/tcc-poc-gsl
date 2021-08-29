<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->is("api/auth") === true)
            return $next($request);
        else {
            $AuthService = new AuthService;
            $tokenDataValidate = $AuthService->validateJWT($request->get('token'));
            if (is_object($tokenDataValidate)) {
                return $tokenDataValidate;
            } else {
                return $next($request);
            }
        }
    }
}
