<?php

// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

try {
    define("DS", DIRECTORY_SEPARATOR);
    define('PROJECT_ROOT', dirname(__FILE__) . DS);
    include_once 'Config/rootConfig.php';

    require_once PROJECT_VENDOR . 'autoload.php';
    require_once PROJECT_CORE . 'Dispatcher.php';

    (new Dispatcher())->dispatch();

} catch (Throwable $t) {
    $errorMessage = $t->getMessage();
    $errorFile = $t->getFile();
    $errorLine = $t->getLine();

    require_once PROJECT_VIEW_F . 'error.php';
}

