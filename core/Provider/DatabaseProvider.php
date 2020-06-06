<?php

namespace Core\Provider;

use Core\Exception\CoreException;

/**
 * Class DatabaseServer
 * @package Config
 */
class DatabaseProvider
{
    private $driver;
    private $host;
    private $database;
    private $user;
    private $password;

    /**
     * DatabaseServer constructor.
     *
     * @param string $databaseKey
     *
     * @throws CoreException
     */
    public function __construct($databaseKey = 'default')
    {
        $config    = ConfigurationProvider::getInstance();
        $databases = $config->getDatabaseConfig();
        if ($databases === null) {
            throw new CoreException('Désolé, nous ne trouvons pas les informations de configuration pour la base de données.');
        }

        $default = $databases[$databaseKey] ?? null;
        if ($databases === null) {
            throw new CoreException("Désolé, La clée pour la base de données $databaseKey n'existe pas.");
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
    public function getPassword(): ?string
    {
        return $this->password;
    }
}
