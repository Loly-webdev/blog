<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

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

try {
    $dispatcher = (new Dispatcher())->dispatch();
} catch (Throwable $t) {
    if ('dev' === PRJ_ENV) {
        $type    = $t->getCode();
        $message = $t->getMessage();
        $file    = $t->getFile();
        $line    = $t->getLine();

        require_once('errors/template/errorsDev.php');
        exit;
    }
    require_once('errors/errorsPage.php');
}
