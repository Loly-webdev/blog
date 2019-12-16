<?php

require_once PROJECT_CORE . 'DefaultController.php';

class Request
{
    private $server;
    private $path;
    private $paths;
    private $query;
    private static $instance = null;

    private function __construct()
    {
        $server = $this->getUrlData();

        if (!empty($server['path'])) {
            $path = trim($server['path'], "/");
            $paths = explode('/', $path);
        }

        $query = $server['query'] ?? null;

        $this->setServer($server)
             ->setPath($path)
             ->setPaths($paths)
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

    private function setPaths($paths)
    {
        $this->paths = $paths;

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

        return parse_url($server);
    }

    public function getPathByKey($key, $defaultValue = null)
    {
        $data = $this->paths;

        return $data[$key] ?? $defaultValue;
    }

    public static function getInstance() {

        if(is_null(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }
}
