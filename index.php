<?php
// Show PHP errors (Delete before prod)
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);


define('DEBUG_TWIG', true);

// Load autoload of composer
require 'vendor/autoload.php';

use App\Controller\ErrorController;
use Core\Dispatcher;

try {
	$dispatcher = new Dispatcher();
	$dispatcher->dispatch();

} catch (Throwable $t) {
    $error = new ErrorController();
    $error->error($t);
}
