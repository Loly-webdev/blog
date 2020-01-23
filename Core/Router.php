<?php

require_once PROJECT_CORE . 'Request.php';

/**
 * Class Router
 *
 * Get from request the controller and action names
 *
 * For exemple :
 * <code>
 * $requestURL = "monsite.fr"
 * $router = new Router();
 * $router->controllerName = "HomeController";
 * $router->actionName = "indexAction";
 *
 * $requestURL = "monsite.fr/blog/test"
 * $router = new Router();
 * $router->controllerName = "BlogController";
 * $router->actionName = "testAction";
 * </code>
 */
class Router
{
    private $controllerName;
    private $actionName;

    public function __construct()
    {
        // on appel l'instance de request afin de recuperer les methode dont nous avons besoin
        $request = Request::getInstance();

        // on recupere via la methode getUrlComponents les informations dont nous avons besoin
        // sinon, on met une valeur par defaut
        $controllerName = $request->getUrLComponents()[0] ?? "Home";
        $actionName = $request->getUrLComponents()[1] ?? "index";

        $this->setControllerName($controllerName)
             ->setActionName($actionName);
    }

    // on ajoute Controller a la fin du nom du controller trouver via la requete getUrlComponents
    public function setControllerName($controllerName)
    {
        $this->controllerName = ucfirst($controllerName) . 'Controller';

        return $this;
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    // on ajoute Action a la fin du nom de l'action trouver via la requete getUrlComponents
    public function setActionName($actionName)
    {
        $this->actionName = $actionName . 'Action';

        return $this;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }
}
