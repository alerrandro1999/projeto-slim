<?php

namespace App\Models;

final class TokenModel
{
    private $id;
    private $token;
    private $refreshToken;
    private $expireAt;
    private $usuariosId ;


    public function getId() : int 
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;
        return $this;
    }

    public function getToken() : string
    {
        return $this->token;
    }

    public function setToken(string $token) : self
    {
        $this->token = $token;
        return $this;
    }

    
    public function getRefreshToken() : string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(string $refreshToken) : self
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    
    public function getExprireAt() : string
    {
        return $this->expireAt;
    }

    public function setExpireAt(string $expireAt) : self
    {
        $this->expireAt = $expireAt;
        return $this;
    }


    public function getUsuariosId() : int
    {
        return $this->usuariosId;
    }

    public function setUsuariosId(int $usuariosId) : self
    {
        $this->usuariosId = $usuariosId;
        return $this;
    }

}