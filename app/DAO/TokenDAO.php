<?php

namespace App\DAO;

use App\Models\TokenModel;

use PDO;

class TokenDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createToken(TokenModel $token) : void
    {
        $statement = $this->pdo
             ->prepare('INSERT INTO tokens (usuarios_id, token, refresh_token, expired_at) 
                        VALUES (:usuariosId, :token, :refreshToken, :expiredAt)' );
        $statement->execute([
            'usuariosId' => $token->getUsuariosId(),
            'token' => $token->getToken(),
            'refreshToken' => $token->getRefreshToken(),
            'expiredAt' => $token->getExprireAt()
        ]);  
    }

    public function verifyRefreshToken(string $refreshToken) : bool
    {
        $statement = $this->pdo->prepare('SELECT id FROM tokens WHERE refresh_token = :refresh_token');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(PDO::FETCH_ASSOC);
        return count($tokens) === 0 ? false : true;
    }

   
}