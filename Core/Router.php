<?php

require_once PROJECT_ROOT . 'Core/DefaultController.php';

class Router
{
    public $controllerName;
    public $actionName;

    public function __construct(Request $request)
    {
        $params = $request->getURLComponents();

        $this->controllerName = $params[0] ?
            ucfirst($this->getURLComponents()[0] . 'Controller') :
            'HomeController';
        $this->actionName = $params[1] ?? 'index';
    }

    private function getURLComponents()
    {
    }
}
