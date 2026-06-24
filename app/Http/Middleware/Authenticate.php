<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $header = $request->header('Authorization');

        if (!$header) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization header not provided'
            ], 401);
        }

        try {

            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Token has expired'
            ], 401);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Token is invalid'
            ], 401);

        } catch (JWTException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Token could not be parsed'
            ], 401);
        }

        return $next($request);
    }

    protected function redirectTo(Request $request): ?string
    {
        return null;
    }
}