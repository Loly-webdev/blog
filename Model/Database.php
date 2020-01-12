<?php

require_once PROJECT_CONFIG . 'dbConfig.php';

class Database
{
    private static $bdd = null;

    public static function getBdd()
    {
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        if (is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                $driverOptions
            );
        }
        return self::$bdd;
    }
}