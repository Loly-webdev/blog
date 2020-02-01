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
        // Load the instance of Request
        $request = Request::getInstance();

        // Find the ControllerName and ActionName with the function getUrlComponents()
        // or return a defaultValue
        $controllerName = $request->getUrLComponents()[0] ?? "Home";
        $actionName = $request->getUrLComponents()[1] ?? "index";

        $this->setControllerName($controllerName)
             ->setActionName($actionName);
    }

    // Add Controller to the controllerName find
    public function setControllerName($controllerName)
    {
        $this->controllerName = ucfirst($controllerName) . 'Controller';

        return $this;
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    // Add Action to the ActionName find
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
