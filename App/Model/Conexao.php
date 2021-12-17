<?php
namespace App\Model;
use Dotenv;
class Conexao
{
    private static $instance;

    private static function env()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->safeLoad();
    }

    public static function getConnection()
    {
        self::env();
        $host = $_ENV['HOST'];
        $dbname = $_ENV['DATABASE'];
        $user = $_ENV['USER'];
        $password = $_ENV['PASSWORD'];
        $charset = $_ENV['CHARSET'];

        if(!isset(self::$instance))
        {
            $conn = "mysql:host=". $host .";dbname=".$dbname.";charset=".$charset;
            self::$instance = new \PDO($conn, $user, $password);
        }
        return self::$instance;
        
    }
}