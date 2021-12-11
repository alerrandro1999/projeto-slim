<?php


namespace App\DAO;

use App\Models\UsuarioModel;

use PDO;

class UsuariosDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmail(string $email) : ?UsuarioModel
    {
       $statement = $this->pdo->prepare('SELECT ID, NOME, EMAIL, SENHA FROM usuarios WHERE EMAIL = :email ');
       $statement->bindParam('email',$email);
       $statement->execute();
       $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);
       $usuario = new UsuarioModel();
       if (count($usuarios) === 0) {
            return null;
       }
       else
       {
        $usuario->setId($usuarios[0]['ID'])
                ->setNome($usuarios[0]['NOME'])
                ->setEmail($usuarios[0]['EMAIL'])
                ->setSenha($usuarios[0]['SENHA']);
        return $usuario;
       }
  
    }
}