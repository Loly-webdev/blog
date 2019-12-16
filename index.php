<?php

// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

try {
    // Defined PROJECT_ROOT
    define('PROJECT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
    define('PROJECT_CORE', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR);
    define('PROJECT_VIEW', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
    define('PROJECT_REPOSITORY', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'Repository' . DIRECTORY_SEPARATOR);

    //database credentials
    define('DB_HOST', 'localhost');
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_NAME', 'blog');

    //set timezone
    date_default_timezone_set('Europe/London');

    require_once PROJECT_CORE . 'Dispatcher.php';


    require_once PROJECT_CORE . 'Router.php';

    $router = new Router();
    var_dump($router);
    //(new Dispatcher())->dispatch();

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    echo 'Caught exception: ', $errorMessage, "\n";
    require_once PROJECT_VIEW . 'Front/errorView.php';
}

