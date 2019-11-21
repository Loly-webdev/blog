<?php

require_once PROJECT_CORE. 'DefaultController.php';
require_once PROJECT_CORE . 'Router.php';

class Dispatcher
{
    private $router;
    private $controller;

    public function __construct(Router $router)
    {
        //new controler
        $controller = $router->getControllerName();
        $this->setRouter($router)
             ->existController()
             ->setController($controller)
             ->existAction()
             ->callControllerAction();
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

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller)
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

    public function callControllerAction()
    {
        $router = $this->getRouter();
        $controller = $this->getController();
        $actionName = $router->getActionName();
        var_dump($controller, $actionName);
        // Execute the method $paramAction of controller
        if (false === $controller instanceof DefaultControllerInterface) {
            throw new Exception(
                'Le controller n\'est pas compatible avec DefaultControllerInterface'
            );
        }

        //call controller's method
        call_user_func(array($controller, $actionName));

        return $this;
    }
}