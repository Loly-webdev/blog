<?php

// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

try {
    // Defined PROJECT_ROOT
    define('PROJECT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

    require_once PROJECT_ROOT . 'Core/Request.php';
    require_once PROJECT_ROOT . 'Core/Router.php';
    require_once PROJECT_ROOT . 'Core/Dispatcher.php';

    $request = new Request();
    $router = new Router($request);
    $dispatcher = new Dispatcher($router);
    $dispatcher->dispatch();

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    echo 'Caught exception: ', $errorMessage, "\n";
    require PROJECT_ROOT . 'View/Front/errorView.php';
}
