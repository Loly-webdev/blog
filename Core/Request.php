<?php

require_once PROJECT_CORE . 'DefaultController.php';

class Request
{
    private $URLComponents;
    private $URLComponentsByKey;

    public function __construct()
    {
        $URLComponents = !empty($this->getURLComponents()[0]) ? $this->getURLComponents()[0]: null;
        $URLComponentsByKey = $this->getURLComponents()[1] ?? null;

        $this->setURLComponents($URLComponents)
             ->setURLComponentsByKey($URLComponentsByKey);

    }

    public function getURLComponents()
    {
        //Place the value from ?params=value in the URL.
        $server = $_SERVER["REQUEST_URI"];
        $serverData = trim(parse_url($server, PHP_URL_PATH), "/");
        $params = explode('/', $serverData);

        return $params;
    }

    public function setURLComponents($URLComponents)
    {
        $this->URLComponents = $URLComponents;

        return $this;
    }

    public function getURLComponentByKey($key, $defaultValue = null)
    {
        $params = $this->getURLComponents();

        return $params[$key] ?? $defaultValue;
    }

    public function setURLComponentsByKey($URLComponentsByKey)
    {
        $this->URLComponentsByKey = $URLComponentsByKey;

        return $this;
    }
}
