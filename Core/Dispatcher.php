<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_CORE . 'Router.php';

/**
 *
 */
class Dispatcher
{
    private $router;

    public function __construct()
    {
        $router = new Router();

        $controllerName = $router->getControllerName();
        $actionName = $router->getActionName();

        $this->setRouter($router)
             ->existController($controllerName)
             ->existAction($actionName)
             ->dispatch();
    }

    //je récupère les infos du router
    public function setRouter(Router $router)
    {
        $this->router = $router;

        return $this;
    }

    //je test si elles sont valables
    //si non j'affiche un message d'erreur via exception
    public function existController(string $controllerName)
    {
        $filename = PROJECT_ROOT . 'Controller/' . $controllerName . '.php';

        if (false === file_exists($filename)) {
            throw new Exception("Le fichier $filename n'existe pas.");
        }

        require_once($filename);

        return $this;
    }

    public function existAction($actionName)
    {
        if (isset($actionName)) {
            throw new Exception("L'argument $actionName n'existe pas.");
        }

        return $this;
    }

    //si oui je les dispatch pour que l'index puisse les afficher
    public function dispatch()
    {
        $router = new Router();
        $controllerName = $router->getControllerName();
        $actionName = $router->getActionName();

        //je vérifie que le controller et compatible
        $controllerCompatible = is_subclass_of($controllerName, 'DefaultControllerInterface');

        if (false === $controllerCompatible) {
            throw new Exception(
                'Le controller ' . $controllerName .  ' n\'est pas compatible avec DefaultControllerInterface'
            );
        }

        var_dump($controllerName, $actionName);

        call_user_func(array($controllerName, $actionName));

        return $this;
    }
}
