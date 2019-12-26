<?php

require_once PROJECT_CORE . 'DefaultController.php';

/**
 * Class Request
 *
 * Get informations of URL
 *
 * For exemple :
 * <code>
 * $requestURL = "monsite.fr/home/test"
 * $server->getUrlData() = parse_url($server);
 * $server->path = trim($server['path']);
 * $server->paths = explode(trim($server['path']));
 * $server->query = $server['query'];
 * $server->getPathByKey() = $data[$key] ?? $defaultValue;
 *
 * </code>
 */
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

    public function setPaths($paths)
    {
        $this->paths = $paths;

        return $this;
    }

    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    public function getUrlData()
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
