<?php

namespace Config;

/**
 * Class DatabaseServer
 * @package Config
 */
class DatabaseServer
{
    private $host     = 'localhost';
    private $database = 'blog';
    private $user     = 'loly';
    private $password = 'root';

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
