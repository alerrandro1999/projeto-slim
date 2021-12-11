<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use \Slim\Http\Response as Response;

use App\DAO\LojasDAO;

use App\Models\LojaModel;

final class LojaController
{
    public function getLojas(Request $request, Response $response, array $args) : Response
    {
      $lojasDAO = new LojasDAO();
      $lojas = $lojasDAO->getAllLojas();
      $response = $response->withJson($lojas);
      return $response;  
    }

    public function insertLojas(Request $request, Response $response, array $args) : Response
    {
      $data = $request->getParsedBody();

      $lojasDAO = new LojasDAO();
      $loja = new LojaModel();
      $loja->setNome($data['nome'])
      ->setEndereco($data['endereco'])
      ->setTelefone($data['telefone']);
      $lojasDAO->insertLoja($loja);

      $response = $response->withJson([
        'message' => 'Loja inserida com sucesso'
      ]);
      
      return $response;  
    }

    public function updateLojas(Request $request, Response $response, array $args) : Response
    {
      return $response;  
    }

    public function deleteLojas(Request $request, Response $response, array $args) : Response
    {
      return $response;  
    }
}