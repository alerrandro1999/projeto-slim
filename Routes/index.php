<?php

use App\Controllers\{
    AuthController,
    LojaController,
    ProdutoController
};
use App\Middlewares\JwtDateTimeMiddleware;
use Tuupola\Middleware\HttpBasicAuthentication;
use Tuupola\Middleware\JwtAuthentication;

use function Src\{
    slimConfiguration,
    JwtAuth
};

function basicAuth() : HttpBasicAuthentication
{
    return new HttpBasicAuthentication([
        "users" => [
            "root" => "teste123"
        ]
    ]);
}

$app = new \Slim\App(slimConfiguration());

//--------------------------------------------------------------------------

$app->post('/login', AuthController::class . ':login');
$app->post('/refresh_token', AuthController::class . ':refreshToken');

$app->get('/teste', function () { echo "oi"; } )
    ->add(new JwtDateTimeMiddleware())
    ->add(JwtAuth());

$app->group('', function() use($app){
    $app->get('/loja', LojaController::class . ':getLojas');
    $app->post('/loja', LojaController::class . ':insertLojas');
    $app->put('/loja', LojaController::class . ':updateLojas');
    $app->delete('/loja', LojaController::class . ':deleteLojas');

    $app->get('/produtos', ProdutoController::class . ':getProdutos');
    $app->post('/produtos', ProdutoController::class . ':inserProdutos');
    $app->put('/produtos', ProdutoController::class . ':updateProdutos');
    $app->delete('/produtos', ProdutoController::class . ':deleteProdutos');
})->add(basicAuth());

//--------------------------------------------------------------------------

$app->run();
