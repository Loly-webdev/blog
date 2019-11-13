<?php

require_once PROJECT_ROOT . 'core/DefaultController.php';

class Router
{
    public function __construct()
    {
        // Test if the controller exist to skip errors
        if (false === file_exists($filename)) {
            throw new Exception("Le fichier $filename n'existe pas.");
        }

        require($filename);

        //$paramController = $params[0] ?? 'home';
        //$paramAction = $params[1] ?? 'index';

        //$controllerName = ucfirst($paramController) . 'Controller';
        //$filename = PROJECT_ROOT . 'controller/' . $controllerName . '.php';

        // Place the value from ?params=value in the URL.
        //$server = $_SERVER["REQUEST_URI"];
        //$serverData = trim(parse_url($server, PHP_URL_PATH), "/");
        //$params = explode('/', $serverData);

        $controller = new $controllerName();
        // Execute the method $paramAction of controller
        if (false === $controller instanceof DefaultControllerInterface) {
            throw new Exception(
                'Le controller n\'est pas compatible avec DefaultControllerInterface'
            );
        }
        call_user_func([$controller, $paramAction . 'Action']);
    }
    public function get...(){

}
}
