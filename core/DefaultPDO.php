<?php

namespace Core;

use Config\DatabaseServer;
use PDO;

/**
 * Class DefaultPDO
 * @package Core
 */
class DefaultPDO
{
    private static $cnx = null;

    /**
     * Connexion with the BDD
     * @return PDO
     */
    public static function PDOConnect(): PDO
    {
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        // Get login information
        if (is_null(static::$cnx)) {
            $dbServer = new DatabaseServer();

            static::$cnx = new PDO(
                "mysql:host=" . $dbServer->getHost()
                . ";dbname=" . $dbServer->getDatabase(),
                $dbServer->getUser(),
                $dbServer->getPassword(),
                $driverOptions
            );
        }

        return static::$cnx;
    }
}
