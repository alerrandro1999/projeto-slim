<?php

namespace App\Controllers;

use App\DAO\TokenDAO;
use App\DAO\UsuariosDAO;
use App\Models\TokenModel;
use DateTime;
use Firebase\JWT\JWT;
use Psr\Http\Message\ServerRequestInterface as Request;

use \Slim\Http\Response as Response;


final class AuthController
{
    public function login(Request $request, Response $response, array $args) : Response
    {
      $data = $request->getParsedBody();
      
      $email = $data['email'];
      $senha = $data['senha'];
      $expireDate = $data['expireData'];

      $usuariosDAO = new UsuariosDAO;

      $usuario = $usuariosDAO->getUserByEmail($email);

      if (is_null($usuario)) {
        return $response->withStatus(401);
      }

      if (!password_verify($senha, $usuario->getSenha())) {
          return $response->withStatus(401);
      }

      $tokenPayload = [
        'sub' => $usuario->getId(),
        'name' => $usuario->getNome(),
        'expired_at' => $expireDate
      ];
      $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

      $refreshTokenPayLoad = [
        'email' => $usuario->getEmail(),
        'ramdom' => uniqid()
      ];

      $refreshToken = JWT::encode($refreshTokenPayLoad, getenv('JWT_SECRET_KEY'));

      $tokenModel = new TokenModel;
      $tokenModel->setExpireAt($expireDate)
                 ->setRefreshToken($refreshToken)
                 ->setToken($token)
                 ->setUsuariosId($usuario->getId());

      $tokenDAO = new TokenDAO;
      $tokenDAO->createToken($tokenModel);

      $response = $response->withJson([
        "token" => $token,
        "refresh_token" => $refreshToken
      ]);

      return $response;  
    }

    public function refreshToken (Request $request, Response $response, array $args) : Response
    {
      $data = $request->getParsedBody();
      $refreshToken = $data['refresh_token'];
      $expireDate = $data['expired_date'];

      $refreshTokenDecoded = JWT::decode(
          $refreshToken,
          getenv('JWT_SECRET_KEY'),
          ['HS256']
      );

      $tokenDAO = new TokenDAO;
      $refreshTokenExists = $tokenDAO->verifyRefreshToken($refreshToken);
      if (is_null($refreshTokenExists)) 
           return $response->withStatus(401);
      $usuariosDAO = new UsuariosDAO;
      $usuario = $usuariosDAO->getUserByEmail($refreshTokenDecoded->email);
      if (is_null($usuario))
           return $response->withStatus(401);
      
     $tokenPayload = [
        'sub' => $usuario->getId(),
        'name' => $usuario->getNome(),
        'expired_at' => $expireDate
      ];
      $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));

      $refreshTokenPayLoad = [
        'email' => $usuario->getEmail(),
        'ramdom' => uniqid()
      ];

      $refreshToken = JWT::encode($refreshTokenPayLoad, getenv('JWT_SECRET_KEY'));

      $tokenModel = new TokenModel;
      $tokenModel->setExpireAt($expireDate)
                 ->setRefreshToken($refreshToken)
                 ->setToken($token)
                 ->setUsuariosId($usuario->getId());

      $tokenDAO = new TokenDAO;
      $tokenDAO->createToken($tokenModel);

      $response = $response->withJson([
        "token" => $token,
        "refresh_token" => $refreshToken
      ]);

      return $response;  
    }
}