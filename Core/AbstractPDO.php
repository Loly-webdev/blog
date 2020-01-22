<?php

require_once PROJECT_CONFIG . 'dbConfig.php';

abstract class AbstractPDO
{
    private static $cnx;

    public abstract static function getHostKey(): string;

    public static function PDOConnect()
    {
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $cnxData = HOSTS[static::getHostKey()] ?? null;

        if (null === $cnxData) {
            // SI la clef de connexion à la bdd existe pas on leve une exeption
            throw new Exception(
                "la clef de connexion à la base de données n'existe pas."
            );
        }

        if (is_null(self::$cnx)) {
            self::$cnx = new PDO(
                "mysql:host=" . $cnxData['host'] . ";dbname=" . $cnxData['name'],
                $cnxData['user'],
                $cnxData['pass'],
                $driverOptions
            );
        }

        return self::$cnx;
    }
}
