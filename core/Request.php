<?php

require_once PROJECT_ROOT . 'core/DefaultController.php';

class Request
{
    protected $controllerName;
    protected $actionName;

    private static $request = null;

    /**
     * Construct analyse the URL path and decomposed it to get Url components.
     * The first element [0] of the URL is the controller name
     * The second element [1] is the action name
     */
    public function __construct()
    {
        $this->controllerName = !empty($this->getURLComponents()[0]) ? ucfirst($this->getURLComponents()[0].'Controller') : null;
        $this->actionName = $this->getURLComponents()[1] ?? null;
    }
}
