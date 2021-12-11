<?php

namespace App\Models;

final class LojaModel
{
    private $id;
    private $nome;
    private $telefone;
    private $endereco;

    public function getId()
    {
        return $this->id;
    }

    
    public function getNome() : string
    {
        return $this->nome;
    }

    
    public function setNome(string $nome) : LojaModel
    {
         $this->nome = $nome;
        return $this;
    }

    public function getTelefone() : string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone) : LojaModel
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getEndereco() : string
    {
        return $this->endereco;
    
    }

    public function setEndereco(string $endereco) : LojaModel
    {
         $this->endereco = $endereco;
        return $this;
    }
}

