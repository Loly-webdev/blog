<?php
try {
    // Shaw PHP errors (Delete before prod)
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);

    // Defined PROJECT_ROOT
    define('PROJECT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

    // Place the value from ?params=value in the URL.
    $server = $_SERVER["REQUEST_URI"];
    $serverData = trim(parse_url($server, PHP_URL_PATH), "/");
    $params = explode('/', $serverData);
    $paramController = $params[0] ?? 'home';
    $paramAction = $params[1] ?? 'index';
    $controllerName = ucfirst($paramController) . 'Controller';
    $filename = PROJECT_ROOT . 'controller/' . $controllerName . '.php';

    // Test if the controller exist to skip errors
    if (false === file_exists($filename)) {
        throw new Exception("Le fichier $filename n'existe pas.");
    }
    require($filename);
    $controller = new $controllerName();
    // Execute the method $paramAction of controller
    if (false === $controller instanceof DefaultControllerInterface) {
        throw new Exception(
            'Le controller n\'est pas compatible avec DefaultControllerInterface'
        );
    }
    call_user_func([$controller, $paramAction . 'Action']);

} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
