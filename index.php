<?php

//tester et a supprimer avant de mettre en prod
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

define('PROJECT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
var_dump(PROJECT_ROOT);

// Place the value from ?page=value in the URL to the variable $page.
$server = $_SERVER["REQUEST_URI"];
$serverData = trim(parse_url($server, PHP_URL_PATH), "/");
$params = explode('/', $serverData);
$paramController = $params[0] ?? 'home';
$paramAction = $params[1] ?? 'index';

//inclure le controller $paramController
require('controller/'. ucfirst($paramController) . 'Controller.php');
$controllerName = $paramController .'Controller';
$controller = new $controllerName;
//faire un filexist de pour tester si le fichier controller existe bien pour eviter les erreurs



//executer la méthode $paramAction du contrôleur $controller
if ($controller instanceof DefaultControllerInterface) {
    call_user_func([$controller, $paramAction . 'Action']);
}

var_dump($controllerName, $controller);


//nettoyer toutes les routes + faire les trow exception des erreurs