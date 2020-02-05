<?php
// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

try {
    define("DS", DIRECTORY_SEPARATOR);
    define('PROJECT_ROOT', dirname(__FILE__) . DS);
    require_once 'Config/rootConfig.php';
    require_once PROJECT_CORE . 'Dispatcher.php';
    require_once 'vendor/autoload.php';

    (new Dispatcher())->dispatch();

} catch (Throwable $t) {
    require_once PROJECT_CONTROLLER . 'ErrorController.php';
    $error = new ErrorController();
    $error->error($t);
}
