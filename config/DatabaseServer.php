<?php

namespace Config;

class DatabaseServer
{
    /*
    voila ton algo
Tu fais un singleton Environment qui contient toutes ta configuration
tu peux l'appeler Configuration, peut importe
    $value = yaml_parse_file ( string $filename [, int $pos = 0 [, int &$ndocs [, array $callbacks = NULL ]]] ) : mixed
$value = Yaml::parseFile('/path/to/file.yaml'); <== tu recuperes la valeur du yml dans une class grace a cette methode
tu lui passes le fichier elle te genere un objet ou un tableau tu regardes ton resultat

    private $host;
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

$dbConfig = $config['database'];

$connectString = $dbConfig['driver']
    . ":host={$dbConfig['host']}"
    . ":database={$dbConfig['database']}"
    . ":user={$dbConfig['user']}"
    . ":password={$dbConfig['password']}";
$dbConnection = new \PDO($connectString, $dbConfig['user'], $dbConfig['password']);
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
