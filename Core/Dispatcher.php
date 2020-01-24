<?php

require_once PROJECT_CORE . 'Router.php';

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
        $this->initRouter()
             ->initController();
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function initRouter()
    {
        $this->router = new Router();

        return $this;
    }

    public function initController()
    {
        $controllerName = $this->getRouter()->getControllerName();
        $controller = PROJECT_CONTROLLER . $controllerName . '.php';

        // Check if the controller exist to return this, or return an exception
        if (false === file_exists($controller)) {
            throw new Exception("Le controller $controller n'existe pas.");
        }
        require_once($controller);

        $this->controller = new $controllerName();

        // Check if the controller find is compatible with DefaultControllerInterface
        $controllerIsCompatible = is_subclass_of($this->controller, 'DefaultControllerInterface');

        if (false === $controllerIsCompatible) {
            throw new Exception(
                'Le controller ' . $controllerName .  ' n\'est pas compatible avec DefaultControllerInterface'
            );
        }
        return $this;
    }

    public function dispatch()
    {
        $controllerName = get_class($this->controller);
        $actionName = $this->getRouter()->getActionName();

        // Check if in the controller the method action exist or return an exception
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
