<?php

abstract class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $database = new Database();

        $this->pdo = $database->connect();
    }
}