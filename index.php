<?php
// Redirections
//header("Status: 301 Moved Permanently", false, 301);
header("Location:/errors/errorsPage.php?erreur= $errorCode");
exit();

// Show PHP errors (Changing the environment from 'dev' to 'prod' for production)
$config = Configuration::getInstance();
$env = $config->getEnvironment();
if ($env === 'dev') {
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);
}

// Load autoload of composer
require 'vendor/autoload.php';

use Config\Configuration;
use Core\Dispatcher;

try {
    dump($_SERVER);
    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();
} catch (Throwable $t) {
    $message = "Une erreur est survenue, veuillez nous excusez de la gène occasionnée.";
    if ($env === 'dev') {
        $message = printf('<strong>Message : </strong>' . $t->getMessage()
            . '<br>
            <strong>Fichier : </strong>' . $t->getFile()
            . '<br>
            <strong>Ligne : </strong>' . $t->getLine());
    }
    require_once('template/errors/errorsManagementView.php');
}
