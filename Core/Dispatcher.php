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
        $filename = PROJECT_CONTROLLER . $controllerName . '.php';

        if (false === file_exists($filename)) {
            throw new Exception("Le fichier $filename n'existe pas.");
        }

        require_once($filename);

        //on récupere l'instance du controller
        $controller = new $controllerName;
        $this->controller = $controller;

        //on vérifie que le controller et compatible
        $controllerIsCompatible = is_subclass_of($controller, 'DefaultControllerInterface');

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
        $methodExist = method_exists($this->controller, $actionName);

        //On regarde si $controller posséde une methode $actionName
        if (false === $methodExist) {
            throw new Exception(
                "L'argument $actionName n'existe pas dans le controleur $controllerName."
            );
        }

        //Dispatch de l'action du controleur
        call_user_func(array($this->controller, $actionName));

        return $this;
    }
}
