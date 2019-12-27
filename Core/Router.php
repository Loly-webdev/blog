<?php

require_once PROJECT_CORE . 'DefaultController.php';
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
    const POSITION_CONTROLLER_NAME = 0;
    const POSITION_ACTION_NAME = 1;
    private $controllerName;
    private $actionName;

    public function __construct()
    {
        $request = Request::getInstance();

        $controllerName = $request->getPathByKey(self::POSITION_CONTROLLER_NAME) ?? "Home";

        $actionName = $request->getPathByKey(self::POSITION_ACTION_NAME) ?? "index";

        var_dump($this->setControllerName($controllerName)
                      ->setActionName($actionName));

        $this->setControllerName($controllerName)
             ->setActionName($actionName);
    }

    public function setControllerName($controllerName)
    {
        $this->controllerName = ucfirst($controllerName) . 'Controller';

        return $this;
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

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
