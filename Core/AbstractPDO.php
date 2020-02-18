<?php

require_once PROJECT_CONFIG . 'config.env.php';

abstract class AbstractPDO
{
    protected static $cnx;

    // Singleton of PDOConnect object to load once this method
    public static function PDOConnect()
    {
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $cnxData = HOSTS[static::getHostKey()] ?? null;

        // Check that login information exists, or return an exception
        if (null === $cnxData) {
            throw new Exception(
                "Les informations de connexion à la base de données ne sont pas valide."
            );
        }

        // Get login information
        if (is_null(static::$cnx)) {
            static::$cnx = new PDO(
                "mysql:host=" . $cnxData['host'] . ";dbname=" . $cnxData['database'],
                $cnxData['user'],
                $cnxData['pass'],
                $driverOptions
            );
        }
        return static::$cnx;
    }

    public abstract static function getHostKey(): string;
}
