<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use JWTAuth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) throw new Exception('UserResource Not Found');
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error_message' => 'Token Invalid'], Response::HTTP_UNAUTHORIZED);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error_message' => 'Token Expired'], Response::HTTP_UNAUTHORIZED);
            } else {
                if ($e->getMessage() === 'UserResource Not Found') {
                    return response()->json(['error_message' => 'UserResource Not Found'], Response::HTTP_UNAUTHORIZED);
                }
                return response()->json(['error_message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
