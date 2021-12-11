<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Message\ServerRequestInterface as Request;

use Psr\Http\Message\ResponseInterface as Response;

final class ProdutoController
{
    public function getProdutos(Request $request, Response $response, array $args) : Response
    {
      return $response;  
    }

    public function insertProdutos(Request $request, Response $response, array $args) : Response
    {
      return $response;  
    }

    public function updateProdutos(Request $request, Response $response, array $args) : Response
    {
      return $response;  
    }

    public function deleteProdutos(Request $request, Response $response, array $args) : Response
    {
      return $response;  
    }
}