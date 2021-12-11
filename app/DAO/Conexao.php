<?php

namespace App\DAO;

use PDO;

abstract class Conexao
{
    protected $pdo;

    public function __construct()
    {
        $host   = getenv('HOST');
        $port   = getenv('port');
        $user   = getenv('user');
        $pass   = getenv('password');
        $dbname = getenv('dbname');    

        $dsn = "mysql:host={$host};dbname={$dbname}";

        $this->pdo = new PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }
}