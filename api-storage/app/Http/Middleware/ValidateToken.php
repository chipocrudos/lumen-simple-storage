<?php

namespace App\Http\Middleware;

use Closure;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Http\Middleware\Check;

class ValidateToken extends Check
{

    public function handle($request, Closure $next)
    {

        if ($this->auth->parser()->setRequest($request)->hasToken()) {
            try {
                $this->auth->parseToken()->getPayload();
            } catch (\Throwable $th) {
                throw new UnauthorizedHttpException('jwt-auth', 'Token not provided');
            }

        } else {
            throw new UnauthorizedHttpException('jwt-auth', 'Token not provided');

        }
        return $next($request);
    }
}