<?php

namespace Src;

function slimConfiguration() : \Slim\Container
{
    $configuration = [
        'settings' => [
            'displayErrorDetails' => getenv('displayErrorDetails'),
        ],
    ];
    return new \Slim\Container($configuration);
}