<?php

namespace Config;

use Exception;

class DatabaseServer
{
    private $driver;
    private $host;
    private $database;
    private $user;
    private $password;

    public function __construct($databaseKey = 'default')
    {
        $config = Configuration::getInstance();
        $databases = $config->getDatabaseConfig();
        if ($databases === null){
            throw new Exception('Désolé, nous ne trouvons pas les informations de configuration pour la base de donnée.');
        }

        $default        = $databases[$databaseKey] ?? null;
        if ($databases === null){
            throw new Exception("Désolé, La clée pour la base de donnée $databaseKey n'existe pas.");
        }

        $this->driver   = $default['driver'] ?? null;
        $this->host     = $default['host'] ?? null;
        $this->database = $default['name'] ?? null;
        $this->user     = $default['user'] ?? null;
        $this->password = $default['password'] ?? null;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
