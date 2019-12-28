<?php

require_once PROJECT_CORE . 'DefaultController.php';

/**
 * Class Request
 *
 * Get informations of URL
 *
 * For exemple :
 * <code>
 * $requestURL = "monsite.fr/home/test?param1=value1&param2=value2"
 * $request = new Request();
 * $request = {
 *     $server = ['path' => '/home/test', 'query' => 'param1=value1&param2=value2'];
 *     $path = "/home/test";
 *     $paths => [0 => "home", 1 => "test"];
 *     $query => 'param1=value1&param2=value2';
 *     $queries => ['param1 => "value1", 'param2' => "value2"];
 * }
 * </code>
 */
class Request
{
    private $server;
    private $path;
    private $paths;
    private $query;
    private $queries;
    private static $instance = null;

    private function __construct()
    {
        $server = $this->getUrlData();

        if (isset($server['path']) && ("/" !== ($server['path']))) {
            $path = trim($server['path'], "/");
            $paths = explode('/', $path);

            $this->setPath($path)
                 ->setPaths($paths);
        }

        $query = $server['query'] ?? null;

        $this->setServer($server)
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
        $paths = $this->paths;

        return $paths[$key] ?? $defaultValue;
    }

    public static function getInstance() {

        if(is_null(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }
}
