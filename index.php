<?php
// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

require_once ('errors/errorsManagement.php');
set_error_handler('errorsManagement');

// Load autoload of composer
require 'vendor/autoload.php';

use Core\Dispatcher;

try {
    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();
} catch (Throwable $t) {
    $type = $t->getCode();
    $message = $t->getMessage();
    $file = $t->getFile();
    $line = $t->getLine();
    require_once('template/errors/errorsManagementView.php');
}
