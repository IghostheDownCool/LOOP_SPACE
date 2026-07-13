<?php
/**
  conexão com sql
 */
class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {

            try {

                self::$connection = new PDO(
                    "mysql:host=" . DB_HOST .
                    ";dbname=" . DB_NAME .
                    ";charset=utf8",
                    DB_USER,
                    DB_PASS
                );

                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {

                die("Erro na conexão: " . $e->getMessage());

            }

        }

        return self::$connection;
    }
}