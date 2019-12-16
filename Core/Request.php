<?php

require_once PROJECT_CORE . 'DefaultController.php';

class Request
{
    private $server;
    private $path;
    private $query;
    private static $instance = null;

    private function __construct()
    {
        $server = $this->getUrlData();

        $path = $server['path'] ?? null;
        $query = $server['query'] ?? null;

        $this->setServer($server)
             ->setPath($path)
             ->setQuery($query);
    }

    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    private function getUrlData()
    {
        $server = $_SERVER["REQUEST_URI"];
        $serverData = trim(parse_url($server, PHP_URL_PATH), "/");

        return explode('/', $serverData);
    }

    public function getPathByKey($key, $defaultValue = null)
    {
        //$path = $this->path; //ça doit retourner /home/test

        $data = ['home', 'test'];

        return $data[$key] ?? $defaultValue;
    }

    public static function getInstance() {

        if(is_null(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }
}
