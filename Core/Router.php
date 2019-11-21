<?php

require_once PROJECT_CORE . 'DefaultController.php';

class Router
{
    private $controllerName;
    private $actionName;

    public function __construct(Request $request)
    {
        $controllerName = $request->getURLComponentByKey(0, 'home');
        $actionName = $request->getURLComponentByKey(1, 'index');

        $this->setControllerName($controllerName)
             ->setActionName($actionName);
    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function setControllerName(string $controllerName)
    {
        $this->controllerName = ucfirst($controllerName) . 'Controller';

        return $this;
    }

    public function getActionName(): string
    {
        return $this->controllerName;
    }

    public function setActionName(string $actionName)
    {
        $this->actionName = $actionName . 'Action';

        return $this;
    }
}
