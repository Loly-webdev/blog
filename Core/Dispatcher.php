<?php

require_once PROJECT_ROOT . 'Core/DefaultController.php';

class Dispatcher
{

    private $controller;
    private $action;
    private $router;
    private $controllerName;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function dispatch()
    {
        $controller = $this->router->controllerName;
        $action = $this->router->actionName;

        $controllerName = ucfirst($controller) . 'Controller';
        $filename = PROJECT_ROOT . 'Controller/' . $action . '.php';

        // Test if the controller exist to skip errors
        if (false === file_exists($filename)) {
            throw new Exception("Le fichier $filename n'existe pas.");
        }
        //include controller
        require_once($filename);

        //new controler
        $controller = new $controllerName();

        // Execute the method $paramAction of controller
        if (false === $controller instanceof DefaultControllerInterface) {
            throw new Exception(
                'Le controller n\'est pas compatible avec DefaultControllerInterface'
            );
        }
        //call controller's method
        call_user_func(array($this->controller, $this->action));

        /*$this->existController()
            ->setController()
            ->existAction()
            ->callControllerAction();*/
    }
}