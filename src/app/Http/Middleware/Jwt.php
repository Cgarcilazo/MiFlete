<?php

namespace App\Http\Middleware;
use App\Http\Controllers\Api\BaseApi;
use App\Http\Controllers\Api\ResponsePackage;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwt
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
        $package = new ResponsePackage();

        if (!$token = auth('api')->setRequest($request)->getToken()) {
            $package->setError(
                'Token not provided',
                BaseApi::HTTP_INVALID_REQUEST
            );
            return $package->toResponse();
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            $package->setError(
                'Token expired',
                BaseApi::HTTP_AUTH_ERROR
            );
            return $package->toResponse();
        } catch (JWTException $e) {
            $package->setError(
                'Token invalid',
                BaseApi::HTTP_INVALID_REQUEST
            );
            return $package->toResponse();
        }

        if (!$user) {
            $package->setError(
                'Account not found',
                BaseApi::HTTP_NOT_FOUND
            );
            return $package->toResponse();
        }

        return $next($request);
    }
}
