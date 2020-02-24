<?php

require 'vendor/autoload.php';

use Core\Dispatcher;

define('DEBUG_TWIG', true);

try {
	$dispatcher = new Dispatcher();
	$dispatcher->dispatch();
} catch (Throwable $t) {
	var_dump($t);
}
