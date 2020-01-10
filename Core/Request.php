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
    private static $instance = null;

    private function __construct()
    {

    }

    public static function getInstance() {

        if(is_null(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function getUrlComponents()
    {
        $server = parse_url($_SERVER["REQUEST_URI"]);
        $path = trim($server['path'], "/");
        return explode('/', $path);
    }

    public function getParam($key, $defaultValue = null)
    {
        return $this->getGetParam($key) ??
               $this->getPostParam($key) ??
               $defaultValue;
    }

    public function getGetParam($key, $defaultValue = null)
    {
        return isset($_GET[$key]) ?
                    ($_GET[$key]) :
                    $defaultValue;
    }

    public function getPostParam($key, $defaultValue = null)
    {
        return isset($_POST[$key]) && '' !== $_POST[$key] ?
                    ($_POST[$key]) :
                    $defaultValue;
    }
}
