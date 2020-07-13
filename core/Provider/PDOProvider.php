<?php

namespace Core\Provider;

use Core\Exception\CoreException;
use PDO;
use PDOException;

/**
 * Class PDOProvider
 * @package Core
 */
class PDOProvider
{
    private static $cnx = null;

    /**
     * Connexion with the BDD
     * @return PDO
     * @throws CoreException
     */
    public static function PDOConnect(): PDO
    {
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        // Get login information
        if (is_null(static::$cnx)) {
            $dbServer = new DatabaseProvider();
            try {
                static::$cnx = new PDO(
                    $dbServer->getDriver()
                    . ':host=' . $dbServer->getHost()
                    . ';dbname=' . $dbServer->getDatabase(),
                    $dbServer->getUser(),
                    $dbServer->getPassword(),
                    $driverOptions
                );
            } catch (PDOException $e) {
                throw new CoreException('Désolé, mais les identifiants de connection à la base de données sont invalide.');
            }
        }

        return static::$cnx;
    }
}
