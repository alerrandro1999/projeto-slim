<?php

namespace App\Middlewares;

use DateTime;
use Slim\Http\Request as Request;
use Slim\Http\Response as Response;

final class JwtDateTimeMiddleware
{
    public function __invoke(Request $request, Response $response, callable $next) : Response
    {
        $token = $request
                      ->getAttribute('jwt');
        $expiredDate = new DateTime($token['expired_at']);
        $now = new DateTime();
        if ($expiredDate < $now) 
            return $response 
                        ->withStatus(401);
        $response = $next($request, $response);
        return $response;
    }
}