<?php
// Load autoload of composer
require 'vendor/autoload.php';

// Load framework constants
require_once 'config/constant.php';

if ('dev' === PRJ_ENV) {
    // Show PHP errors (Delete before prod)
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);
}

use Core\Dispatcher;

$codeHTTP = http_response_code();
try {
    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();
} catch (Throwable $t) {
    if ('dev' === PRJ_ENV) {
        $type = $t->getCode();
        $message = $t->getMessage();
        $file = $t->getFile();
        $line = $t->getLine();

        require_once('errors/template/errorsManagementView.php');
        exit;
    }

    require_once('errors/errorsPage.php');
}
