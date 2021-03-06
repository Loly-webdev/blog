<?php

namespace Core;

use Core\Exception\CoreException;

/**
 * Class Dispatcher
 * Retrieve URL and parameter information for dispatching to controllers
 * @package Core
 */
class Dispatcher
{
    private $router;
    private $controller;

    /**
     * Dispatcher constructor.
     */
    public function __construct()
    {
        $this->router     = new Router();
        $controllerName   = $this->router->getControllerName();
        $controllerPath   = $this->router->isAdmin()
            ? '\\App\\Controller\\Admin\\'
            : '\\App\\Controller\\';
        $controller       = $controllerPath . $controllerName;
        $this->controller = new $controller();
    }

    /**
     * Retrieve URL and parameter information for dispatching to controllers
     * @return Dispatcher
     * @throws CoreException
     */
    public function dispatch(): Dispatcher
    {
        $controllerName = get_class($this->controller);
        $actionName     = $this->router->getActionName();

        // Check that the controller action method exists
        if (false === method_exists($this->controller, $actionName)) {
            throw new CoreException(
                "La méthode $actionName n'existe pas dans le controleur $controllerName."
            );
        }
        // Dispatch the controller action
        call_user_func([$this->controller, $actionName]);

        return $this;
    }
}
