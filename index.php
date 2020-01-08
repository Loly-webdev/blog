<?php

// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

try {
    // Defined PROJECT_ROOT
    define('PROJECT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
    define('PROJECT_CORE', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR);
    define('PROJECT_VIEW', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
    define('PROJECT_MANAGER', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'Manager' . DIRECTORY_SEPARATOR);
    define('PROJECT_VENDOR', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);
    define('PROJECT_TWIG', PROJECT_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'twig' . DIRECTORY_SEPARATOR);

    //database credentials
    define('DB_HOST', 'localhost');
    define('DB_USER', '');
    define('DB_PASS', '');
    define('DB_NAME', 'blog');

    //set timezone
    date_default_timezone_set('Europe/London');

    require_once PROJECT_VENDOR . 'autoload.php';
    require_once PROJECT_CORE . 'Dispatcher.php';

    (new Dispatcher())->dispatch();

} catch (Throwable $t) {
    $errorMessage = $t->getMessage();
    $errorFile = $t->getFile();
    $errorLine = $t->getLine();

    require_once PROJECT_VIEW . 'Front/error.php';
}

