<?php

require_once PROJECT_CORE . 'Router.php';

/**
 *
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

        if (false === file_exists($controller)) {
            throw new Exception("Le controller $controller n'existe pas.");
        }

        require_once($controller);

        //on récupere l'instance du controller
        $this->controller = new $controllerName();

        //on vérifie que le controller et compatible
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

        //On regarde si $controller posséde une methode $actionName
        if (false === method_exists($this->controller, $actionName)) {
            throw new Exception(
                "La méthode $actionName n'existe pas dans le controleur $controllerName."
            );
        }

        //Dispatch de l'action du controleur
        call_user_func(array($this->controller, $actionName));

        return $this;
    }
}
