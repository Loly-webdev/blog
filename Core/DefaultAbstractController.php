<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once PROJECT_CORE . 'DefaultControllerInterface.php';

abstract class DefaultAbstractController implements DefaultControllerInterface
{
    protected $request;
    protected static $twig;

    public function __construct()
    {
        $this->setRequest();
    }

    public function setRequest()
    {
        $this->request = Request::getInstance();

        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public static function getTwig()
    {
        // instance of Twig
        if (null === static::$twig) {
            require_once PROJECT_VENDOR . 'autoload.php';
            $loader = new FilesystemLoader('View/');
            static::$twig = new Environment($loader,
                // To the prod define the path of directory Cache, else to dev keep false
                [
                    'cache' => false
                ]
            );
        }
        return static::$twig;
    }

    public function renderView($viewName, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = PROJECT_VIEW;
        $viewFolder = $viewFolder ?? $this->getFolderView();
        $view = $this->getTwig()->render($viewFolder . $viewName, $params);

        //check if the view exist or return of exception
        if (false === file_exists($defaultPath . $viewFolder . $viewName)) {
            throw new Exception("La vue $defaultPath . $viewFolder . $viewName n'existe pas.");
        }
        echo $view;
    }

    public function getFolderView(): string
    {
        // Define the view directory
        return 'template/front/';
    }
}
