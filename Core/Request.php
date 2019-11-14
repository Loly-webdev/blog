<?php

require_once PROJECT_ROOT . 'Core/DefaultController.php';

class Request
{
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

    public function getURLComponents()
    {
        //Place the value from ?params=value in the URL.
        $server = $_SERVER["REQUEST_URI"];
        $serverData = trim(parse_url($server, PHP_URL_PATH), "/");
        $params = explode('/', $serverData);

        var_dump($params);
    }

    //+3 méthodes
//getParam
//getGetParam
//getPostParam
}
