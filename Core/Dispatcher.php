<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_CORE . 'Router.php';

/**
 *
 */
class Dispatcher
{
    private $router;
    private $controllerName;
    private $actionName;

    public function __construct()
    {
        $router = new Router();

        $controllerName = $router->getControllerName() ?? "HomeController";
        $actionName = $router->getActionName() ?? "indexAction";

        $this->setRouter($router)
             ->setControllerName($controllerName)
             ->existController()
             ->setActionName($actionName)
             ->existAction()
             ->dispatch();

        var_dump($this);
    }

    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }

    public function existController()
    {
        $controllerName = $this->getControllerName();
        $filename = PROJECT_ROOT . 'Controller/' . $controllerName . '.php';

        if (false === file_exists($filename)) {
            throw new Exception("Le fichier $filename n'existe pas.");
        }

        require_once($filename);

        return $this;
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function setControllerName(string $controllerName)
    {
        $this->controllerName = $controllerName;

        return $this;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    private function setActionName(string $actionName)
    {
        $this->actionName = $actionName;

        return $this;
    }

    public function existAction()
    {
        $actionName = $this->getActionName();

        if (false === isset($actionName)) {
            throw new Exception("L'argument $actionName n'existe pas.");
        }

        var_dump($this);
        return $this;
    }

    public function dispatch()
    {
        $controller = $this->getControllerName();
        $action = $this->getActionName();
        $controllerCompatible = is_subclass_of($controller, 'DefaultControllerInterface');

        if (false === $controllerCompatible) {
            throw new Exception(
                'Le controller ' . $controller .  ' n\'est pas compatible avec DefaultControllerInterface'
            );
        }

        call_user_func(array($controller, $action));

        return $this;
    }
}
