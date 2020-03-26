<?php

namespace Config;

class DatabaseServer
{
    /*private $host;
    private $database;
    private $user;
    private $password;

    public function __construct()
    {
        $config         = Environment::getDatabaseconfig();
        $this->host     = $config['host'];
        $this->database = $config['name'];
        $this->user     = $config['user'];
        $this->password = $config['password'];
    }*/

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
