<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once PROJECT_CORE . 'DefaultControllerInterface.php';

abstract class DefaultController implements DefaultControllerInterface
{
    protected static $twig = null;

    public function getTwig()
    {
        if (null === static::$twig) {
            require_once PROJECT_VENDOR . 'autoload.php';
            $loader = new FilesystemLoader('View/');
            static::$twig = new Environment($loader
            /*, [
            'cache' => 'Cache',
             ]*/
            );
        }
        return static::$twig;
    }

    public function renderView($view, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = PROJECT_VIEW;
        $viewFolder = $viewFolder ?? $this->getFolderView();

        if (file_exists($defaultPath . $viewFolder . $view)) {
            echo $this->getTwig()->render($viewFolder . $view, $params);
        }
    }

    public function getFolderView() : string
    {
        return 'template/front/';
    }
}
