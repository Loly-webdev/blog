<?php

namespace Core;

use Exception;

/**
 * Class Dispatcher
 *
 * Get informations of URL and params to dispatch controller action
 */
class Dispatcher
{
    private $router;
    private $controller;

    public function __construct()
    {
        $this->router = new Router();
	    $controllerName = $this->router->getControllerName();
	    $controller = '\\App\\Controller\\' . $controllerName;
	    $this->controller = new $controller();
    }

    public function dispatch()
    {
        $controllerName = get_class($this->controller);
        $actionName = $this->router->getActionName();

        // Check that the controller action method exists
        if (false === method_exists($this->controller, $actionName)) {
            throw new Exception(
                "La méthode $actionName n'existe pas dans le controleur $controllerName."
            );
        }
        // Dispatch the controller action
        call_user_func(array($this->controller, $actionName));

        return $this;
    }
}
