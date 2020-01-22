<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once PROJECT_CORE . 'DefaultControllerInterface.php';

abstract class DefaultAbstractController implements DefaultControllerInterface
{
    private $request;
    protected static $twig = null;

    public function getRequest()
    {
        return $this->request = Request::getInstance();
    }

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

    public function getFolderView(): string
    {
        return 'template/front/';
    }
}
