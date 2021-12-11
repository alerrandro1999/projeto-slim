<?php

namespace Src;

use Tuupola\Middleware\JwtAuthentication;

function JwtAuth() : JwtAuthentication
{
    return new JwtAuthentication([
        'secret' => getenv('JWT_SECRET_KEY'),
        'attribute' => 'jwt'
    ]);
}