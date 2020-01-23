<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';

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
 *     $server = [
 *          'path' => '/home/test',
 *          'query' => 'param1=value1&param2=value2', // $_GET
 *     ];
 * }
 * </code>
 */
class Request
{
    private static $instance = null;

    private function __construct(){
    }

    public static function getInstance() {

        // singleton de l'objet request,
        // qui permet d'instancier une seule fois la methode
        if(is_null(self::$instance)) {
            self::$instance = new Request();
        }

        return self::$instance;
    }

    public function getUrlComponents()
    {
        // on recupere les informations de l'url pour pouvoir les utiliser
        $server = parse_url($_SERVER["REQUEST_URI"]);
        $path = trim($server['path'], "/");
        return "" !== $path ? explode('/', $path) : [];
    }

    public function getParam($key, $defaultValue = null)
    {
        // on recupere les parametre d'action de $_POST et $_GET
        return $this->getRequestParam($key) ??
               $this->getQueryParam($key) ??
               $defaultValue;
    }

    public function getRequestParam($key, $defaultValue = null)
    {
        // $_POST = on recupere les requetes envoye par la methode post
        return isset($_POST[$key]) && '' !== $_POST[$key] ?
                    $_POST[$key] :
                    $defaultValue;
    }

    public function getQueryParam($key, $defaultValue = null)
    {
        // $_GET = parse_url($_SERVER["REQUEST_URI"])['query'];
        return isset($_GET[$key]) && '' !== $_GET[$key] ?
                    $_GET[$key] :
                    $defaultValue;
    }
}
