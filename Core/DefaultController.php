<?php

require_once PROJECT_CORE . 'DefaultControllerInterface.php';

abstract class DefaultController implements DefaultControllerInterface
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('View/');
        $this->twig = new \Twig\Environment($loader
            //, [
            //'cache' => 'Cache',
       // ]
        );
    }

    public function renderView($partial, array $params = [])
    {
        echo $this->twig->render($partial, $params);
    }
}
