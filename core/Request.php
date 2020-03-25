<?php

namespace Core;

/**
 * Class Request
 * Get informations of URL
 * For exemple :
 * <code>
 * $requestURL = "monsite.fr/home/test?param1=value1&param2=value2"
 * $request = new Request();
 * $request = {
 *     $server = [
 *          'path' => '/home/test',
 *          'query' => 'param1=value1&param2=value2', // $_GET
 *     ];
 * }
 * </code>
 */
final class Request
{
    protected static $instance; // Contiendra l'instance de notre classe.

    protected function __construct()
    {
    } // Empêche la création d'une instance

    protected function __clone()
    {
    } // Interdit l'accès à la méthode __clone()

    public static function getInstance()
    {
        // singleton of request object to load once this method
        if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
        {
            self::$instance = new self; // On s'instancie nous-mêmes. :)
        }

        return self::$instance;
    }

    public function getUrlComponents()
    {
        // Get information of URL
        $server = parse_url($_SERVER["REQUEST_URI"]);
        $path   = trim($server['path'], "/");

        return "" !== $path ? explode('/', $path) : [];
    }

    public function getParam($key, $defaultValue = null)
    {
        // Get params $_POST et $_GET
        return $this->getQueryParam($key) ??
               $this->getRequestParam($key) ??
               $defaultValue;
    }

    public function getQueryParam($key, $defaultValue = null)
    {
        // $_GET = parse_url($_SERVER["REQUEST_URI"])['query'];
        return isset($_GET[$key]) && '' !== $_GET[$key]
            ? $_GET[$key]
            : $defaultValue;
    }

    public function getRequestParam($key, $defaultValue = null)
    {
        // $_POST = params recover by $_POST method
        return isset($_POST[$key]) && '' !== $_POST[$key]
            ? $_POST[$key]
            : $defaultValue;
    }
}
