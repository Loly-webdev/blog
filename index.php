<?php

// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

try {
    // Defined PROJECT_ROOT
    define('PROJECT_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

    require PROJECT_ROOT . 'core/Request.php';
    require PROJECT_ROOT . 'core/Router.php';

    $request = new Request();
    //$router = new Router($request);

    echo "Bonjour!";

} catch (Exception $e) {
    echo 'Détail de l\' exception: ', $e->getMessage(), "\n";
}
