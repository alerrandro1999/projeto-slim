<?php

namespace Src;

function basicAuth() : HttpBasicAuthentication
{
    return new HttpBasicAuthentication([
        "users" => [
            "root" => "teste123"
        ]
    ]);
}