<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_CORE . 'Router.php';

class Dispatcher
{
    private $router;
    private $controller;

    public function __construct()
    {
        $router = new Router();
        var_dump($router);

        $controller = $router->getControllerName();
        $controller = new $controller;

        $this->setRouter($router)
             ->existController()
             ->setController($controller)
             ->existAction();

        var_dump($this);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }

    public function existController()
    {
        $router = $this->getRouter();
        $controllerName = $router->getControllerName();
        $filename = PROJECT_ROOT . 'Controller/' . $controllerName . '.php';

        // Test if the controller exist to skip errors
        if (false === file_exists($filename)) {
            throw new Exception("Le fichier $filename n'existe pas.");
        }
        //include controller
        require_once($filename);

        return $this;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    public function existAction()
    {
        $router = $this->getRouter();
        $actionName = $router->getActionName();

        // Test if the action exist to skip errors
        if (false === isset($actionName)) {
            throw new Exception("L'argument $actionName n'existe pas.");
        }

        return $this;
    }

    public function dispatch()
    {
        $router = $this->getRouter();
        $controller = $this->getController();
        $actionName = $router->getActionName();
        $controllerCompatible = is_subclass_of($controller, 'DefaultControllerInterface');
        // Execute the method $paramAction of controller
        if (false === $controllerCompatible) {
            throw new Exception(
                'Le controller' . $controller .  ' n\'est pas compatible avec DefaultControllerInterface'
            );
        }

        //call controller's method
        call_user_func(array($controller, $actionName));

        return $this;
    }
}