<?php
/**
    Conexão com MySQL.
*/
require_once __DIR__ . '/../app/core/Autoload.php';

class Database
{
    private string $host = "localhost";
    private string $dbname = "loop_space";
    private string $user = "root";
    private string $password = "aDon@2$4.Noda";

    private ?PDO $connection = null;

    public function connect(): PDO
    {
        if ($this->connection === null) {

            try {

                $this->connection = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                    $this->user,
                    $this->password
                );

                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {

                die("Erro na conexão: " . $e->getMessage());

            }

        }

        return $this->connection;
    }
}