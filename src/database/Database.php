<?php
namespace Vidbu\Fuckingaround\database;

use PDO;

class Database
{
    private static string $host = "192.168.10.10";
    private static string $database = "vaje";
    private static string $user = "homestead";
    private static string $password = "secret";
    protected static PDO $conn;


    /**
     * Creates connection if it doesn't exist and
     * returns it.
     * @return PDO
     */
    public static function connect(): PDO
    {
        if (!isset(self::$conn)) {
            self::$conn = new PDO(
                "mysql:host=".self::$host.";dbname=".self::$database,
                self::$user,
                self::$password,
            );
        }
        return self::$conn;
    }
}